<!DOCTYPE html>
<html>

<head>
    <title>Delivery Slip</title>
</head>

<body>
    <h1>Bale Delivery Slip</h1>
    <hr>
    <h3>Details</h3>
    <p> Bale No :{{ $bale_name }}</p>
    <p> Bale Unique : No{{ $unique_no }}</p>
    <p> Weight : {{ $weight }}</p>
    <p> Grade : {{ $grade_id }}</p>
    <p> Vehicle Registation : {{ $transport_id }}</p>
    <p> Delivery Date : {{ $created_at }}</p>


    Signed by :______________________________________
    <br>
    <br>

    <br>

    <hr>

</body>

</html>