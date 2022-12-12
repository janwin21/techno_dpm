<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>
</head>
<body>

<!-- Header content -->
{{ $header ?? '' }}

<div class="card mail-card">

    <!-- Email Body -->
    <div class="card bg-dark text-white">
        <img src="{{ asset('images/monster-images/the-legendary-exodia-incarnate.jpg') }}" class="card-img-top" alt="email-card-img">
        <div class="card-img-overlay d-flex flex-column justify-content-end">
            <div class="header">
                <h4 class="card-title mb-2">Deck Pro Master</h4>
                <p class="card-text">A web application that helps you to create your own card and manage deck with the combination of the existing cards and the cards you created.</p>
                <p class="card-text"><small><i>Email Sent {{ date('d-m-Y H:i:s') }}</i></small></p>
            </div>
        </div>
    </div>

    <!-- Body content -->
    <div class="card-body p-4">
        {{ Illuminate\Mail\Markdown::parse($slot) }}
    </div>

    {{ $subcopy ?? '' }}
</div>

{{ $footer ?? '' }}

</body>
</html>
