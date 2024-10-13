<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ __("VIAInfo Contact form submission") }}</title>
    <style>
        body {
            background-color: rgb(243, 244, 246);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: rgb(67, 56, 202);
            padding: 1rem;
            text-align: center;
        }

        .header h1 {
            color: white;
            margin: 0;
        }

        .content-box {
            background-color: white;
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            padding: 1rem;
            margin: 1rem;
            text-align: center;
        }

        .button {
            display: inline-flex;
            gap: 1rem;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 2rem;
            background-color: rgb(79, 70, 229);
            color: white;
            text-decoration: none;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            transition: all 0.2s ease-in-out;
        }

        .button:hover {
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<p>esti beat?</p>
<div class="header">
    <h1>{{ __("VIAInfo Contact form submission") }}</h1>
</div>

<div class="content-box">
    <p>{{ __("You have received a message from the contact form at the VIAInfo website.") }}</p>
    <div>
        <p>{{ __("First name") }}: {{ $submission->first_name }}</p>
        <p>{{ __("Last name") }}: {{ $submission->last_name }}</p>
        <p>{{ __("Email") }}: {{ $submission->email }}</p>
        @if ($submission->phone_number)
            <p>{{ __("Phone number") }}: {{ $submission->phone_number }}</p>
        @endif
        <p>{{ __("Message") }}: {{ $submission->message }}</p>
    </div>

    <a
        href="{{ route("admin.contact.show", [ "contact" => $submission ]) }}"
        class="button"
    >
        {{ __("Open in app") }}
    </a>
</div>

</body>
</html>
