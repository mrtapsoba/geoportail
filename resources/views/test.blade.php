<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="geoportail/getData" method="post">
        @csrf
        <input type="text" name="shapefile">
        <input type="submit" value="send">
    </form>

    <h2>form 2 contrib add delimit</h2>

    <form action="{{ route('postDelimit') }}" method="post" enctype="multipart/form-data">
        @csrf @csrf
        <div class="form-group mb-2">
            <input type="integer" name="coucheId">
        </div>
        <div class="form-group mb-2">
            <input type="text" name="objet" class="form-control" placeholder="Objet de la contribution">
        </div>
        <div class="form-group mb-2">
            <textarea name="desc" id="desc" class="form-control" id="" cols="30" rows="5" placeholder="Description"></textarea>
        </div>
        <input type="file" name="file">
        <div class="form-group mt-3 mb-2">
            <button type="submit" id="saveForm" class="form-control submit-btn btn rounded submit px-3">ENVOYER</button>
        </div>
    </form>
</body>

</html>
