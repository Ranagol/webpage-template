@extends('layout')

@section('content')

<article class="feature-card mb-3">
    <h1>Challenge 3: Train task (in terminal)</h1>
</article>

<section  aria-label="Train task details">
    <article class="feature-card">
        <h2>Challenge description</h2>
        <p style="text-align: justify;">
            A train line has two stations on it, A and B. Trains can take trips from A to B or
            from B to A multiple times during a day. When a train arrives at B from A (or arrives
            at A from B), it needs a certain amount of time before it is ready to take the return
            journey - this is the turnaround time.
        </p>
        <p style="text-align: justify;">
            For example, if a train arrives at 12:00 and the turnaround time is 0 minutes, it can
            leave immediately, at 12:00.
        </p>
        <p style="text-align: justify;">
            A train timetable specifies departure and arrival time of all trips between A and B.
            The train company needs to know how many trains have to start the day at A and B in
            order to make the timetable work: whenever a train is supposed to leave A or B, there
            must actually be one there ready to go. There are passing sections on the track, so
            trains do not necessarily arrive in the same order that they leave. Trains may not
            travel on trips that do not appear on the schedule.
        </p>

        <h3>Input</h3>
        <p style="text-align: justify;">
            The first line of input gives the number of cases, N. N test cases follow.
        </p>
        <p style="text-align: justify;">
            Each case contains a number of lines. The first line is the turnaround time, T, in
            minutes. The next line has two numbers on it, NA and NB. NA is the number of trips
            from A to B, and NB is the number of trips from B to A. Then there are NA lines giving
            the details of the trips from A to B.
        </p>
        <p style="text-align: justify;">
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

        {{-- Train illustration --}}
        <div style="text-align: center;">
            <img 
                src="images/trains.png" 
                alt="Illustration of the train task" 
                style="width: 50%; max-width: 100%; height: auto;"
            >
        </div>

        <p class="mt-4">Sample input with explanation</p>
        <pre>2                   // Number of test cases that we want to solve
5                   // Turnaround time in case 1
3 2                 // Number of trips from Station A to B and from Station B to A
09:00 12:00         // Trip from A to B, departs at 09:00 and arrives at 12:00
10:00 13:00         // Trip from A to B, departs at 10:00 and arrives at 13:00
11:00 12:30         // Trip from A to B, departs at 11:00 and arrives at 12:30
12:02 15:00         // Trip from B to A, departs at 12:02 and arrives at 15:00
09:00 10:30         // Trip from B to A, departs at 09:00 and arrives at 10:30
2                   // Turnaround time in case 2
2 0                 // Number of trips from Station A to B and from Station B to A
09:00 09:01         // Trip from Station A to B, departs at 09:00 and arrives at 09:01
12:00 12:02         // Trip from Station A to B, departs at 12:00 and arrives at 12:02</pre>






        <h3>Output</h3>
        <p>
            For each test case, output one line containing "Case #x: " followed by the number of
            trains that must start at Station A and the number of trains that must start at Station B.
        </p>
        <p>Sample output (with explanation)</p>
        <pre>Case #1: 2 2     // For case #1, two trains must start from Station A, and two trains must start from Station B
Case #2: 2 0     // For case #2, two trains must start from Station A, and no trains need to start from Station B</pre>
    </article>

    {{-- How to test this feature --}}
    <article class="feature-card mt-3">
        <h2>How to test this feature?</h2>
        <p>Type this command into terminal:</p>
        <pre>docker compose exec -it php bash</pre>
        <p>Run the app with this command:</p>
        <pre>cat domain/Trains/taskDataOriginal | php console.php trains</pre>
        <p><strong>Expected output</strong></p>
        <pre>Case #1: 2 2
Case #2: 2 0</pre>
    </article>
</section>

@endsection