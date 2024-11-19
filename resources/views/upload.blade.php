@extends('layout')

@section('content')

@php
    use App\models\User;

    if(!isset($_SESSION)){ 
        session_start(); 
    }
    // Here we check if the user is logged in
    $user = User::getCurrentUser();
@endphp

<!-- Success message OR warning message if something is wrong with the upload. In the controller
there is a validation logic, that can - if needed - create error messages. -->
<div 
    class="alert 
        {{ isset($alertType) && ($alertType === 'alert-success') ? 'alert-success' : 'alert-warning' }}
        {{ isset($message) && (!empty($message)) ? '' : 'd-none' }}
    "
>
    {{ $message }}
</div>

<!-- UPLOAD CSV FILE. This form will be displayed only if the user is logged in -->
<form 
    action="upload" 
    method="post" 
    enctype="multipart/form-data" 
    class="form-group {{ $user ? '' : 'd-none' }}"
>
    <h2 class='mt-3'>Upload file</h2>
    <div class='mt-3'>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="file" id="fileSelect" class='form-control-file'>
    </div>
    <div class='mt-3'>
        <input type="submit" name="submit" value="Upload" class='btn btn-warning'>
    </div>
    <p>
        <strong>Note: max allowed file size is 5 MB. Only .jpg, .png, and .csv
                files can be uploaded.
        </strong> 
    </p>
</form>

<!-- REPORT CREATED FROM THE UPLOADED CSV FILE -->
<!-- Once a .csv file is uploaded, the app will do some calculations on this data, and it will
1 - display the results of this calculation
2 - return the result of this calculation, also in .csv file. Which will be downloadable.
This is the report that can be downloaded. -->
<div class='{{ isset($report) ? '' : 'd-none' }}'>
    <h2 class='mt-3'>Report</h2>

    <!-- DISPLAY THE REPORT IN A TABLE FOR THE USER -->
    <table class='table'>
        <tr>
            <th>Category</th>
            <th>Cost</th>
        </tr>

        <!-- This is the fancy version of the foreach loop. The ':' is needed -->
        @foreach ($report as $category => $cost)
        <tr>
            <td>{{ $category }}</td>
            <td>{{ $cost }}</td>
        </tr>
        @endforeach
    </table>

    <!-- DOWNLOADING THE REPORT AS A .CSV FILE -->
    @php
        if(isset($report)){
            /**
             * We put the $report that we want to download into the session, so this data will be 
             * accessible to our controller later
             */
            $_SESSION['downloadRequest'] = $report;
        }
    @endphp

    <!-- DOWNLOAD REPORT BUTTON -->
    <form 
        action="download-report" 
        method="GET"
    >
        <button 
            class='btn btn-success'
        >Download report</button>
    </form>
    
</div>

<!-- Warning message if the user is not logged in -->
<div 
    class="alert alert-warning {{ $user ? 'd-none' : '' }} "
>
    Please log in, if you want to upload a file.
</div>

@endsection