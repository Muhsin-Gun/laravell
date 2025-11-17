@extends('layout')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 style="color: #00e5ff; margin-bottom: 30px;">Help & Support</h1>

    <div style="background: #1e1e1e; padding: 40px; border-radius: 12px; border: 1px solid #333; margin-bottom: 30px;">
        <h2 style="color: #00ff9e; margin-bottom: 20px;">Contact Us</h2>
        <p style="color: #ccc; line-height: 1.8; margin-bottom: 15px;">
            If you have any questions or issues, please contact our support team:
        </p>
        <p style="color: #ccc; line-height: 1.8;">
            📧 Email: <a href="mailto:support@carrental.com" style="color: #00e5ff;">support@carrental.com</a><br>
            📞 Phone: <a href="tel:+1234567890" style="color: #00e5ff;">+1234567890</a><br>
            ⏰ Available: 24/7
        </p>
    </div>

    <div style="background: #1e1e1e; padding: 40px; border-radius: 12px; border: 1px solid #333;">
        <h2 style="color: #00ff9e; margin-bottom: 20px;">Frequently Asked Questions</h2>
        <div style="margin-bottom: 20px;">
            <h3 style="color: #00e5ff; margin-bottom: 10px;">How do I book a car?</h3>
            <p style="color: #ccc; line-height: 1.6;">Browse our available cars, select your desired vehicle, choose your dates, and complete the booking process.</p>
        </div>
        <div style="margin-bottom: 20px;">
            <h3 style="color: #00e5ff; margin-bottom: 10px;">What payment methods do you accept?</h3>
            <p style="color: #ccc; line-height: 1.6;">We accept M-PESA payments for your convenience.</p>
        </div>
        <div>
            <h3 style="color: #00e5ff; margin-bottom: 10px;">Can I cancel my booking?</h3>
            <p style="color: #ccc; line-height: 1.6;">Yes, you can cancel your booking. Please contact our support team for assistance.</p>
        </div>
    </div>
</div>
@endsection
