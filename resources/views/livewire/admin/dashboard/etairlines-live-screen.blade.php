<div
    wire:poll.1s="checkForNewRegistrations"
    style="
        min-height: 100vh;
        padding: 40px;
        background: #07152f;
        color: white;
    ">

    <div style="text-align: center; margin-bottom: 40px;">

        <h1 style="font-size: 42px; font-weight: 800;">
            ✈️ ETAIRLINES
        </h1>

        <h2>
            Participantes en vivo
        </h2>

        <div style="
            display: inline-block;
            margin-top: 15px;
            padding: 10px 25px;
            border-radius: 50px;
            background: rgba(255,255,255,.12);
        ">
            👥
            <strong>
                {{ number_format($totalParticipants) }}
            </strong>
            participantes
        </div>

    </div>


    <div style="
        max-width: 1000px;
        margin: auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    ">

        @forelse($participants as $participant)

        <div
            wire:key="participant-{{ $participant['id'] }}"
            style="
                    padding: 20px;
                    border-radius: 15px;
                    background: rgba(255,255,255,.10);
                    border: 1px solid rgba(255,255,255,.15);
                    font-size: 20px;
                    font-weight: 700;
                ">

            {{ $participant['name'] }}

        </div>

        @empty

        <div style="
                grid-column: 1 / -1;
                text-align: center;
                padding: 80px 20px;
            ">

            <div style="font-size: 60px;">
                👥
            </div>

            <h2>
                Esperando participantes...
            </h2>

            <p style="opacity: .6;">
                Los participantes aparecerán aquí automáticamente.
            </p>

        </div>

        @endforelse

    </div>

</div>