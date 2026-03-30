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

<section class="upload-page-header" aria-labelledby="upload-page-title">
    <p class="hero-kicker">Upload workflow</p>
    <h1 id="upload-page-title">Upload files and generate CSV reports</h1>
    <p class="hero-lead upload-page-lead">
        Upload a JPG, PNG, or CSV file. When you upload an expenses CSV, the app calculates
        the summary by category, shows the result in a table, and lets you download the report.
    </p>
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
                    Choose an image or CSV file to store or process. CSV uploads are summarized into a downloadable report.
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
            <strong>Note: max allowed file size is 5 MB. Only .jpg, .png, and .csv
                    files can be uploaded.
            </strong>
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

<section class="upload-task-brief feature-card mt-4" aria-labelledby="claromentis-task-title">
    <p class="hero-kicker">Challenge brief</p>
    <h2 id="claromentis-task-title">Claromentis PHP Developer Test Task</h2>

    <div class="upload-task-copy">
        <p>
            The task is to run some calculations and display results based on data from an uploaded CSV file.
            CSV stands for comma separated values - a format supported by Excel or any other spreadsheets software.
        </p>
        <p>
            The source data is an imaginary expenses report and the goal of the programme is to display
            total cost per expense category.
        </p>
        <p>
            Once the summary data has been calculated and displayed, it should be possible to generate
            and download a report CSV file with the same data as displayed in the table.
        </p>
        <p>
            An example of a possible page layout is shown on the screenshot, but how you lay it out is up to you.
        </p>
    </div>

    <div class="upload-task-grid">
        <article class="upload-task-panel">
            <h3>File format</h3>
            <p>
                The expected source file does not have any headers, and contains the following three columns:
            </p>
            <ul class="upload-task-list">
                <li><strong>category.</strong> String. May be one of a few values, not defined in advance (the set of available values can be different in different CSV files)</li>
                <li><strong>price.</strong> Numeric. Cost per item</li>
                <li><strong>amount.</strong> Numeric. Number of items</li>
            </ul>
        </article>

        <article class="upload-task-panel">
            <h3>Example file</h3>
            <a class="btn btn-primary btn-sm upload-sample-download" href="/downloads/csvFile.csv" download>
                Download sample csvFile.csv
            </a>
            <div class="upload-task-examples">
                <div class="upload-task-sample">
                    <p class="upload-task-label">Example file in Excel:</p>
                    <table class="table upload-task-table mb-0">
                        <tbody>
                            <tr>
                                <td>Hotel</td>
                                <td>10</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Hotel</td>
                                <td>70</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>Fuel</td>
                                <td>1.21</td>
                                <td>24</td>
                            </tr>
                            <tr>
                                <td>Food</td>
                                <td>31</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td>Fuel</td>
                                <td>1.18</td>
                                <td>10</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="upload-task-sample">
                    <p class="upload-task-label">Plain text:</p>
                    <pre class="upload-task-pre">Hotel,10,2
Hotel,70,3
Fuel,1.21,24
Food,31,6
Fuel,1.18,10</pre>
                </div>
            </div>
        </article>
    </div>
</section>

@endsection


