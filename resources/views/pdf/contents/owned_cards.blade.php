<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Deck Pro Master</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .table-title {
            font-size: 1.25em;
        }

        .data-table {
            margin: 1rem;
            background-color: white;
        }

        .data-table h3 {
            font-size: 2.25em;
            margin-top: -0.5rem;
            margin-bottom: 0;
        }
        
        .data-table .btn-primary {
            padding: 0.25rem 0.5rem;
        }
        
        .data-table table {
            border-collapse: collapse;
            margin: 1rem 0;
            width: 100%;
        }
        
        .data-table table td, .data-table table th {
            padding: 0.5rem;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    
    <div class="container-fluid bg-dark p-4">
        <div class="jumbotron data-table">
            <h3>Card Table</h3>
            <p>This are all the data of your card stored from our database.</p>
            <hr class="my-4">

            <p class="mt-4"><strong>Primary Table</strong></p>
            <!-- PRIMARY TABLE -->
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID</th>
                        <th style="width: 15%">Card Name</th>
                        <th>Type (Monster)</th>
                        <th>Type (Non-Monster)</th>
                        <th>Attribute</th>
                        <th><img src="{{ public_path('images/star-images/level.png') }}" alt="img" style="width: 1em; margin-left: 0.5rem; margin-top: 0.15rem;"> Level</th>
                        <th><img src="{{ public_path('images/star-images/rank.png') }}" alt="img" style="width: 1em; margin-left: 0.5rem; margin-top: 0.15rem;"> Rank</th>
                        <th>Link Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->cards as $cards)
                    <tr>
                        <td>{{ ++$data['counter'] }}</td>
                        <td>{{ $cards->card_main_id }}</td>
                        <td>{{ $cards->card_name }}</td>
                        <td>{{ $cards->card_template }}</td>
                        <td>{{ $cards->non_monster_type }}</td>
                        <td><img src="{{ public_path('images/attributes-images/' . $cards->card_attribute . '.png') }}" alt="img" style="width: 1em; margin-left: 0.5rem; margin-top: 0.15rem;"> {{ $cards->card_attribute }}</td>
                        <td>{{ $cards->card_level }}</td>
                        <td>{{ $cards->card_rank }}</td>
                        <td>{{ $cards->link_rating }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
            <p class="mt-4"><strong>Secondary Table</strong></p>
            <!-- SECONDARY TABLE -->
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th style="width: 15%">Card Name</th>
                        <th>Rarity</th>
                        <th>Effect</th>
                        <th>Pendulum Scale</th>
                        <th>Link Markers</th>
                        <th>Summon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->cards as $cards)
                    <tr>
                        <td>{{ $data['counter'] }}</td>
                        <td>{{ $cards->card_name }}</td>
                        <td>{{ $cards->card_rarity }}</td>
                        <td>{{ $cards->card_effect }}</td>
                        <td><strong>&lt;</strong> {{ $cards->card_scale_left }} | {{ $cards->card_scale_right }} <strong>&gt;</strong></td>
                        <td>{{ $cards->link_marker }}</td>
                        <td>{{ $cards->card_summoning }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
            <p class="mt-4"><strong>Detailed Table</strong></p>
            <!-- DETAILED TABLE -->
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th style="width: 15%">Card Name</th>
                        <th>ATK</th>
                        <th>DEF</th>
                        <th>Pendulum Effect</th>
                        <th>Card Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->cards as $cards)
                    <tr>
                        <td>{{ $data['counter'] }}</td>
                        <td>{{ $cards->card_name }}</td>
                        <td>{{ $cards->card_atk }}</td>
                        <td>{{ $cards->card_def }}</td>
                        <td>{{ $cards->card_pendulum_effect }}</td>
                        <td>{{ $cards->card_description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
            <p class="mt-4"><strong>Manufacturer Table</strong></p>
            <!-- MANUFACTURER TABLE -->
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th style="width: 15%">Card Name</th>
                        <th>Card ID</th>
                        <th>Serial No.</th>
                        <th>Copyright</th>
                        <th>Stamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->cards as $cards)
                    <tr>
                        <td>{{ $data['counter']++ }}</td>
                        <td>{{ $cards->card_name }}</td>
                        <td>{{ $cards->card_id }}</td>
                        <td>{{ $cards->card_serial_number }}</td>
                        <td>&copy;{{ $cards->card_copyright }}</td>
                        <td>{{ $cards->card_stamp }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</body>
</html>