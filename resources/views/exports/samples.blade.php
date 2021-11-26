<!DOCTYPE html>
<html>
    <head>
        <title>Samples</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      </head>
   <body>
    <h1 style="text-center" style="width:100%">Samples Overall Status Of Project {{ $projectName }}</h1>
      <table class="table">
        <tr>
            <th>Sample Title</th>
            <th>Description</th>
            <th>Manufacturer</th>
            <th>Model No</th>
            @foreach ($dynamicFields as $value)
            <th>{{ $value }}</th>
            @endforeach
            <th>Finish<th>
            <th>Sample Url</th>
            <th>Overall Status</th>
            <th>Comments</th>
        </tr>
        @foreach ($samples as $sample)
            <tr>
                <td>{{ $sample->title }}</td>
                <td>{{ $sample->description }}</td>
                <td>{{ $sample->manufacturer }}</td>
                <td>{{ $sample->model_no }}</td>
                @foreach ($sample->dynamic_fields as $field)
                <td>{{ $field }}</td>
                @endforeach
                <td>{{ $sample->finish }}</td>
                <td>{{ $sample->sample_url }}</td>
                <td>{{ $sample->overall_status }}</td>
                <td>{{ $sample->comments }}</td>
            </tr>
        @endforeach
      </table>
   </body>
</html>
