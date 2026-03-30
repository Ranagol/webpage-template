@extends('layout')

@section('content')

<h1>Challenge 3: Train task (in terminal)</h1>

<section  aria-label="Train task details">
    <article class="feature-card">
        <h3>Challenge description</h3>
        <p>
            A train line has two stations on it, A and B. Trains can take trips from A to B or
            from B to A multiple times during a day. When a train arrives at B from A (or arrives
            at A from B), it needs a certain amount of time before it is ready to take the return
            journey - this is the turnaround time.
        </p>
        <p>
            For example, if a train arrives at 12:00 and the turnaround time is 0 minutes, it can
            leave immediately, at 12:00.
        </p>
        <p>
            A train timetable specifies departure and arrival time of all trips between A and B.
            The train company needs to know how many trains have to start the day at A and B in
            order to make the timetable work: whenever a train is supposed to leave A or B, there
            must actually be one there ready to go. There are passing sections on the track, so
            trains do not necessarily arrive in the same order that they leave. Trains may not
            travel on trips that do not appear on the schedule.
        </p>

        <h3>Input</h3>
        <p>
            The first line of input gives the number of cases, N. N test cases follow.
        </p>
        <p>
            Each case contains a number of lines. The first line is the turnaround time, T, in
            minutes. The next line has two numbers on it, NA and NB. NA is the number of trips
            from A to B, and NB is the number of trips from B to A. Then there are NA lines giving
            the details of the trips from A to B.
        </p>
        <p>
            Each line contains two fields, giving the HH:MM departure and arrival time for that
            trip. The departure time for each trip will be earlier than the arrival time. All
            arrivals and departures occur on the same day. The trips may appear in any order - they
            are not necessarily sorted by time. The hour and minute values are both two digits,
            zero-padded, and are on a 24-hour clock (00:00 through 23:59).
        </p>
        <p>
            After these NA lines, there are NB lines giving the departure and arrival times for
            the trips from B to A.
        </p>

        <h3>Output</h3>
        <p>
            For each test case, output one line containing "Case #x: " followed by the number of
            trains that must start at A and the number of trains that must start at B.
        </p>

        <h3>Limits</h3>
        <p>Time limit: 30 seconds per test set.</p>
        <p>Memory limit: 1GB.</p>

        <h3>Sample input</h3>
        <pre>25
3 2
09:00 12:00
10:00 13:00
11:00 12:30
12:02 15:00
09:00 10:30
2
2 0
09:00 09:01
12:00 12:02</pre>
        <h3>Sample output</h3>
        <pre>Case #1: 2 2
Case #2: 2 0</pre>

    </article>

    <article class="feature-card">
        <h3>Run in this app</h3>
        <p>
            Start the terminal in docker container:
        </p>
        <pre>docker-compose exec -it php-container bash</pre>
        <p>
            Run the app and input the train timetable.
        </p>
        <p>
            On Linux, folder names are case-sensitive. Use <strong>app/Trains</strong> exactly as shown.
        </p>
        <p><strong>Original task data</strong></p>
        <pre>cat app/Trains/taskDataOriginal | php console.php trains</pre>
        <p><strong>Expected output</strong></p>
        <pre>Case #1: 2 2
Case #2: 2 0</pre>
        <p><strong>Big task data created in this project</strong></p>
        <pre>cat app/Trains/taskDataBig | php console.php trains</pre>
        <p><strong>Expected output</strong></p>
        <pre>Case #1: 2 2
Case #2: 2 0
Case #3: 2 2
Case #4: 2 0
Case #5: 2 2
Case #6: 2 0
Case #7: 2 2
Case #8: 2 0</pre>
    </article>
</section>

@endsection