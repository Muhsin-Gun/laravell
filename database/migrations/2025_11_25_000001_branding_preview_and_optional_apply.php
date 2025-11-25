<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This migration acts in two modes:
     * - Preview mode (default): it will print counts and sample rows containing 'Future'.
     * - Apply mode: if environment variable `APPLY_BRANDING` is set to '1', it will replace
     *   occurrences of 'Future' with 'NEXUS Premium Cars' in known textual columns.
     */
    public function up()
    {
        $apply = env('APPLY_BRANDING', false);
        $this->printLine("Branding migration started (apply=" . ($apply ? 'true' : 'false') . ")");

        $tables = [
            // table => [columns to search/update]
            'cars' => ['name', 'description'],
            'blogs' => ['title', 'content'],
            'settings' => ['value']
        ];

        foreach ($tables as $table => $cols) {
            // Skip if table doesn't exist
            try {
                $exists = DB::select("SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?", [$table]);
            } catch (\Throwable $e) {
                // Fallback for sqlite: check sqlite_master
                try {
                    $exists = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name=?", [$table]);
                } catch (\Throwable $e) {
                    $exists = [];
                }
            }

            if (empty($exists)) {
                $this->printLine(" - Table '$table' not found, skipping.");
                continue;
            }

            foreach ($cols as $col) {
                try {
                    $countRes = DB::select("SELECT COUNT(*) as cnt FROM $table WHERE $col LIKE ?", ['%Future%']);
                    $count = $countRes[0]->cnt ?? 0;
                } catch (\Throwable $e) {
                    continue;
                }

                if ($count > 0) {
                    $this->printLine("Table $table.$col: $count occurrences");

                    if ($apply) {
                        // Perform an update using REPLACE
                        DB::statement("UPDATE $table SET $col = REPLACE($col, 'Future', 'NEXUS Premium Cars') WHERE $col LIKE ?", ['%Future%']);
                        $this->printLine("  -> Replaced occurrences in $table.$col");
                    } else {
                        // show a few sample rows
                        $rows = DB::select("SELECT id, $col FROM $table WHERE $col LIKE ? LIMIT 5", ['%Future%']);
                        foreach ($rows as $r) {
                            $val = is_object($r) ? (property_exists($r, $col) ? $r->$col : '') : '';
                            $this->printLine("   - id=" . (is_object($r) ? $r->id : '') . " -> " . mb_substr($val, 0, 120));
                        }
                    }
                } else {
                    $this->printLine("Table $table.$col: 0 occurrences");
                }
            }
        }

        $this->printLine('Branding migration finished.');
    }

    public function down()
    {
        // no-op automatic rollback for branding changes; would require prior backup to reverse.
    }

    protected function printLine($msg)
    {
        // migrations run under artisan; echo is fine for user visibility
        echo $msg . PHP_EOL;
    }
};
