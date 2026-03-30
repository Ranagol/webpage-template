@extends('layout')

@section('content')

@php
    use App\Models\User;

    if(!isset($_SESSION)){ 
        session_start(); 
    }
    // Here we check if the user is logged in
    $user = User::getCurrentUser();
@endphp

<h1>Challenge 2: File Upload & Processing</h1>

<section class="upload-task-brief feature-card mt-4" aria-labelledby="claromentis-task-title">
    <h2 id="claromentis-task-title">Challenge description</h2>

    <div class="upload-task-copy">
        <p style="text-align:justify;">
            The task is to run some calculations and display results based on data from an uploaded CSV file.
            CSV stands for comma separated values - a format supported by Excel or any other spreadsheets software.
            The source data is an imaginary expenses report and the goal of the program is to display
            total cost per expense category.
            Once the summary data has been calculated and displayed, it should be possible to generate
            and download a report CSV file with the same data as displayed in the table.
            An example of a possible page layout is shown on below.
        </p>

        <h3>File format</h3>
        <p>
            The expected source file does not have any headers, and contains the following three columns:
        </p>
        <ul class="upload-task-list">
            <li><strong>category.</strong> String. May be one of a few values, not defined in advance 
                (the set of available values can be different in different CSV files).
            </li>
            <li><strong>price.</strong> Numeric. Cost per item.</li>
            <li><strong>amount.</strong> Numeric. Number of items.</li>
            <li>Some categories may be repeated in the file, and the program should sum up the costs 
                for these categories. For example, if there are two rows with category "Hotel", then 
                the total cost for "Hotel" should be calculated as sum of these two categories.
            </li>
        </ul>
    </div>

    <h3>Example .csv file for uploading</h3>
    
    <div>
        <div>Hotel, 10, 2</div>
        <div>Hotel, 70, 3</div>
        <div>Fuel, 1.21, 24</div>
        <div>Food, 31, 6</div>
        <div>Fuel, 1.18, 10</div>
    </div>

    

</section>


<!-- Success message OR warning message if something is wrong with the upload. In the controller
there is a validation logic, that can - if needed - create error messages. -->
<div 
    class="alert upload-feedback 
        {{ isset($alertType) && ($alertType === 'alert-success') ? 'alert-success' : 'alert-warning' }}
        {{ isset($message) && (!empty($message)) ? '' : 'd-none' }}
    "
>
    {{ $message }}
</div>


{{-- How to test the upload functionality --}}
<section class="upload-main-card feature-card mt-3">

    <h2>How to test the upload functionality?</h2>

    {{-- Download sample CSV file  --}}
    <a class="btn btn-primary mt-3 btn-sm upload-sample-download" href="/downloads/csvFile.csv" download>
        Download the example csv file
    </a>

    <p>

        Simply click on the 'Download the example csv file' button. Then, in the 'Upload file' section
        upload this downloaded file back to the server. The app will process the data, and it will show the 
        calculated summary in a table. You can also download the report as a .csv file, by clicking on the
        'Download report' button.
    </p>
</section>

<!-- UPLOAD CSV FILE. This form will be displayed only if the user is logged in -->
<section class="upload-main-card feature-card {{ $user ? '' : 'd-none' }}">
    <form 
        action="upload" 
        method="post" 
        enctype="multipart/form-data" 
        class="form-group upload-form mb-0"
    >
        <div class="upload-section-head">
            <div>
                <h2 class='mt-0'>Upload file</h2>
                <p class="upload-section-text mb-0">
                    Choose a CSV file to process. CSV uploads are summarized into a downloadable report.
                </p>
            </div>
        </div>
        <div class='mt-3'>
            <label for="fileSelect">Filename:</label>

            <input type="file" name="file" id="fileSelect" class='form-control-file'>
        </div>

        <div class='mt-3'>
            <input type="submit" name="submit" value="Upload" class='btn btn-warning'>
        </div>

        <p class="upload-note mb-0">
            Note: max allowed file size is 5 MB. Only .csv files can be uploaded.
        </p>
    </form>
</section>

<!-- REPORT CREATED FROM THE UPLOADED CSV FILE -->
<!-- Once a .csv file is uploaded, the app will do some calculations on this data, and it will
1 - display the results of this calculation
2 - return the result of this calculation, also in .csv file. Which will be downloadable.
This is the report that can be downloaded. -->
<section class='upload-report-card feature-card {{ isset($report) ? '' : 'd-none' }}'>
    <div class="upload-section-head">
        <div>
            <h2 class='mt-0'>Report</h2>
            <p class="upload-section-text mb-0">
                Calculated totals grouped by category from the uploaded expenses CSV.
            </p>
        </div>
        <span class="upload-stat-pill">{{ isset($report) ? count($report) : 0 }} categories</span>
    </div>

    <!-- DISPLAY THE REPORT IN A TABLE FOR THE USER -->
    <div class="table-responsive">
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
    </div>

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
        class="upload-report-actions"
    >
        <button 
            class='btn btn-success'
        >Download report</button>
    </form>
    
</section>

<!-- Warning message if the user is not logged in -->
<div 
    class="alert alert-warning upload-feedback {{ $user ? 'd-none' : '' }} "
>
    Please log in, if you want to upload a file.
</div>



@endsection


