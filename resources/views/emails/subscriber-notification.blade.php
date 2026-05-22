<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    {{-- Header --}}
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); padding: 40px 40px 30px; text-align: center;">
                            <img src="{{ asset('images/ndpcc-logo.png') }}" alt="NDPCC" style="height: 50px; margin-bottom: 15px;">
                            <h1 style="color: #ffffff; font-size: 22px; margin: 0; font-weight: 700;">Nayoth Divine Power Christian Centre</h1>
                            <p style="color: rgba(255,255,255,0.7); font-size: 13px; margin: 8px 0 0;">A Fortress of God — A Refuge for His People</p>
                        </td>
                    </tr>

                    {{-- Gold accent bar --}}
                    <tr>
                        <td style="background-color: #d4a017; height: 4px;"></td>
                    </tr>

                    {{-- Content --}}
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #1e1b4b; font-size: 24px; margin: 0 0 20px; font-weight: 700;">{{ $heading }}</h2>
                            <div style="color: #4b5563; font-size: 16px; line-height: 1.7;">
                                {!! nl2br(e($body)) !!}
                            </div>

                            @if($buttonText && $buttonUrl)
                            <table cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                <tr>
                                    <td style="background-color: #d4a017; border-radius: 10px; padding: 14px 32px;">
                                        <a href="{{ $buttonUrl }}" style="color: #ffffff; text-decoration: none; font-weight: 700; font-size: 16px;">{{ $buttonText }}</a>
                                    </td>
                                </tr>
                            </table>
                            @endif
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px 40px; border-top: 1px solid #e5e7eb;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: center;">
                                        <p style="color: #6b7280; font-size: 13px; margin: 0 0 10px;">
                                            Nayoth Divine Power Christian Centre — Arusha, Tanzania
                                        </p>
                                        <p style="color: #6b7280; font-size: 13px; margin: 0 0 10px;">
                                            📞 +255 784 363 502 | ✉️ info@ndpccenter.co.tz
                                        </p>
                                        @if($subscriber)
                                        <p style="margin: 15px 0 0;">
                                            <a href="{{ url('/unsubscribe/' . $subscriber->token) }}" style="color: #9ca3af; font-size: 12px; text-decoration: underline;">Unsubscribe</a>
                                        </p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
