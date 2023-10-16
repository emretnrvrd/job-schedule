@extends("layouts.default")


@section("content")

<div class="mb-5" style="max-width: 500px; margin: 0 auto;">
    <h5>
        {{ $week_duration }} Week
   </h5>
   <h5>
        {{ $day_duration }} Days
   </h5>
</div>



@foreach ($schedule as $index => $devDailySchedules)
<div class="mb-5" style="max-width: 500px; margin: 0 auto;">

    <h4>
        DAY {{ $index + 1 }}
    </h4>
    <table class="table-info">
        <thead>
            <tr>

                <th>Developer</th>
                <th>Jobs</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devDailySchedules as $devDailySchedule)
                <tr>
                    <td>{{ $devDailySchedule->getDeveloper()->name }}</td>

                    <td>
                        <ul class="list-group">

                            @foreach ($devDailySchedule->getJobs() as $sheduleJob)
                                <li class="list-group-item">
                                    {{ $sheduleJob["job"]->remote_id }}
                                    <small>({{$sheduleJob["effort"]}} Effort)</small>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>

@endforeach



@endsection
