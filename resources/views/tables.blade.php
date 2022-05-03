@extends('layouts.master')

@section('table')
    @foreach($cohorts as $name => $cohort)
        <div class="h4">{{ $name }}</div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Frequency</th>
                    <th scope="col">Daily Frequency</th>
                    <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cohort->participants as $participant)
                    <tr>
                        <th scope="row">{{ $participant->id }}</th>
                        <td>{{ $participant->first_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($participant->date_of_birth)->format('d-m-Y') }}</td>
                        <td>{{ $participant->frequency->name }}</td>
                        <td>{{ $participant->dailyFrequency ? $participant->dailyFrequency->name : 'none' }}</td>
                        <td>{{ \Carbon\Carbon::parse($participant->created_at)->format('H:i:s d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
@stop
