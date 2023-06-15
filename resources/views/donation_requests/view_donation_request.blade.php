<x-app-layout>
    <x-slot name="header">
        Donation Request details
    </x-slot>
    <b>id:</b> {{ $donation_request->id }}
    <br>
    <b>patient name:</b> {{ $donation_request->patient_name }}
    <br>
    <b>patient phone:</b> {{ $donation_request->patient_phone }}
    <br>
    <b>hospital name:</b> {{ $donation_request->hospital_name }}
    <br>
    <b>bags num:</b>{{ $donation_request->bags_num }}
    <br>
    <b>patient age:</b> {{ $donation_request->id }}
    <br>
    <b>hospital address:</b>{{ $donation_request->hospital_address }}
    <br>
    <b>latitude:</b>{{ $donation_request->latitude }}
    <br>
    <b>longitude:</b>{{ $donation_request->longitude }}
    <br>
    <b>details:</b> {{ $donation_request->details }}
    <br>
    <b>city:</b>{{ $donation_request->city->name }}
    <br>
    <b>governorate:</b>{{ $donation_request->city->governorate->name }}
    <br>
    <b>blood_type:</b>{{ $donation_request->bloodType->name }}
    <br>
    <b>client:</b>{{ $donation_request->client->name }}
    <br>
    <b>client:</b>{{ $donation_request->client->phone }}


</x-app-layout>
