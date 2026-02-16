<!DOCTYPE html>
<html>
<head>
    <title>New Contact Submission</title>
</head>
<body>
    <h1>New Contact Submission</h1>
    <p><strong>Name:</strong> {{ $submission->name }}</p>
    <p><strong>Email:</strong> {{ $submission->email }}</p>
    <p><strong>Subject:</strong> {{ $submission->subject }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $submission->message }}</p>
</body>
</html>
