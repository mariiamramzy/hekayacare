<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Appointment Request</title>
</head>
<body>
    <h2>New Appointment Request</h2>

    <p><strong>Name:</strong> {{ $appointmentRequest->name }}</p>
    <p><strong>Phone:</strong> {{ $appointmentRequest->phone }}</p>
    <p><strong>Governorate:</strong> {{ $appointmentRequest->governorate }}</p>
    <p><strong>Gender:</strong> {{ $appointmentRequest->gender === 'male' ? 'ذكر' : 'انثي' }}</p>
    <p><strong>Age:</strong> {{ $appointmentRequest->age }}</p>
    <p><strong>Patient Relation:</strong> {{ $appointmentRequest->patient_relation === 'self' ? 'مريض' : 'نايب عن المريض' }}</p>
    <p><strong>Problem Type:</strong> {{ $appointmentRequest->problem_type }}</p>
    <p><strong>Problem Specialty:</strong> {{ $appointmentRequest->problem_specialty }}</p>
    <p><strong>Notes:</strong> {{ $appointmentRequest->notes ?: '-' }}</p>
    <p><strong>Status:</strong> {{ $appointmentRequest->status }}</p>
</body>
</html>
