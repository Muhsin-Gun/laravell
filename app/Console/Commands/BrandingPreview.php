<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BrandingPreview extends Command
{
    protected $signature = 'branding:preview';
    protected $description = 'Preview database rows containing the string "Future" so you can review before applying branding changes.';

    public function handle()
    {
        $this->info("Scanning known tables for the string 'Future'...");

        $tables = [
            'cars' => ['id', 'name', 'description'],
            'blogs' => ['id', 'title', 'content'],
            'settings' => ['id', 'value']
        ];

        foreach ($tables as $table => $cols) {
            // Determine DB driver and check table existence appropriately
            $connection = config('database.default');
            $driver = config("database.connections.$connection.driver");

            try {
                if ($driver === 'sqlite') {
                    $existsRes = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name=?", [$table]);
                    $exists = !empty($existsRes);
                } else {
                    // Assume MySQL or compatible
                    $count = DB::select("SELECT COUNT(*) as cnt FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = ?", [$table]);
                    $exists = (isset($count[0]) && (($count[0]->cnt ?? $count[0]->CNT ?? 0) > 0));
                }
            } catch (\Throwable $e) {
                $this->line(" - Table '$table' not found or cannot be checked: " . $e->getMessage());
                continue;
            }

            if (!$exists) {
                $this->line(" - Table '$table' not found, skipping.");
                continue;
            }

            $this->info("\nChecking table: $table");
            $found = false;
            foreach ($cols as $col) {
                try {
                    $rows = DB::select("SELECT id, $col FROM $table WHERE $col LIKE ? LIMIT 10", ['%Future%']);
                } catch (\Throwable $e) {
                    // Column might not exist on that table
                    continue;
                }

                if (!empty($rows)) {
                    $found = true;
                    $this->info(" Found matches in column '$col' (showing up to 10):");
                    foreach ($rows as $r) {
                        $val = is_object($r) ? (property_exists($r, $col) ? $r->$col : '') : (is_array($r) ? ($r[$col] ?? '') : '');
                        $this->line("  - id=" . (is_object($r) ? $r->id : $r['id']) . " -> " . mb_substr($val, 0, 120));
                    }
                }
            }

            if (!$found) {
                $this->line(" No occurrences found in $table.");
            }
        }

        $this->info("\nPreview complete. To apply changes create a backup and run the migration with environment variable APPLY_BRANDING=1 before running `php artisan migrate`.");
        return 0;
    }
}
