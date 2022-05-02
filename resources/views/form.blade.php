@extends('layouts.master')

@section('form')
    <div class="pb-5 d-flex justify-content-end">
        <a
            href="{{ route('participants.store') }}"
            class="btn btn-primary"
        >
            Results Table
        </a>
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif

    <form method="POST" action="{{ route('participants.store') }}">
        @csrf

        <div class="form-group">
            <label for="firstName">First name</label>
            <input
                id="firstName"
                type="text"
                name="first_name"
                class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                placeholder="First name"
                value="{{ old('first_name') }}"
            />
            @if ($errors->has('first_name'))
                <div class="invalid-feedback">
                    {{ $errors->first('first_name') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="dateOfBirth">Date of birth</label>
            <input
                id="dateOfBirth"
                type="date"
                name="date_of_birth"
                class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                placeholder="dd-mm-yyyy"
                value="{{ old('date_of_birth') }}"
            />
            @if ($errors->has('date_of_birth'))
                <div class="invalid-feedback">
                    {{ $errors->first('date_of_birth') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="form-group col-6">
                <label for="frequencyId">The frequency of migraine headaches</label>
                <select
                    id="frequencyId"
                    name="frequency_id"
                    class="custom-select {{ $errors->has('frequency_id') ? 'is-invalid' : '' }}"
                >
                    <option value>-- None --</option>
                    @foreach ($frequencies as $frequency)
                        <option value="{{ $frequency->id }}" {{ old('frequency_id') == $frequency->id ? 'selected' : '' }}>
                            {{ $frequency->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('frequency_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('frequency_id') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-6">
                <label for="dailyFrequencyId">The daily frequency of migraine headaches</label>
                <select
                    id="dailyFrequencyId"
                    name="daily_frequency_id"
                    class="custom-select {{ $errors->has('daily_frequency_id') ? 'is-invalid' : '' }}"
                >
                    <option value="">-- None --</option>
                    @foreach ($dailyFrequencies as $dailyFrequency)
                        <option
                            value="{{ $dailyFrequency->id }}"
                            {{ old('daily_frequency_id') == $dailyFrequency->id ? 'selected' : '' }}
                        >
                            {{ $dailyFrequency->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('daily_frequency_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('daily_frequency_id') }}
                    </div>
                @endif
            </div>
        </div>

        <input type="submit" name="send" value="Submit" class="btn btn-primary btn-block">
    </form>
@stop
