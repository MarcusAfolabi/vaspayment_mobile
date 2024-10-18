@extends('layouts.app')
@section('title', 'All transactions')
@section('main')
<x-header />
@livewire('transactions.all')
<script>
    // Initialize OneSignal
    OneSignal.push(function() {
        OneSignal.init({
            appId: "ac40ca7d-8dc1-408b-ad17-ab8a587ae901",
        });

        // Subscribe and get the player ID (device ID)
        OneSignal.on('subscriptionChange', function(isSubscribed) {
            if (isSubscribed) {
                OneSignal.getUserId(function(playerId) {
                    // Send playerId to your backend for saving
                    console.log("Player ID: ", playerId);
                    savePlayerIdToBackend(playerId);
                });
            }
        });
    });

    function savePlayerIdToBackend(playerId) {
        fetch('https://api.vaspayment.com/api/v1/save-player-id', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                player_id: playerId
            })
        });
    }
</script>
@endsection