<!DOCTYPE html>
<html>
   <head>
      <style>
        /* table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        } */
      </style>
   </head>
   <body>
      <table>
          <tr>
                <td colspan="7" align="center">
                  <h1 style="width:100%;font-weight:bold;">Samples Overall Status Of Project {{ $projectName }}</h1>
                </td>
            </tr>
        <tr>
            <th>Sample Id</th>
            <th>Total Signature</th>
            <th>Signed Signature</th>
            <th>UnSigned Signature</th>
            <th>Approved Signature<th>
            <th>Rejected Signature</th>
        </tr>
        @foreach ($samples as $sample)
            <tr>
                <td>{{ $sample->title }}</td>
                <td>{{ $sample->total_signature }}</td>
                <td>{{ $sample->signed_signature }}</td>
                <td>{{ $sample->unsigned_signature }}</td>
                <td>{{ $sample->approved_signature }}</td>
                <td>{{ $sample->rejected_signature }}</td>
            </tr>
        @endforeach
      </table>
   </body>
</html>
