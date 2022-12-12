@extends('layouts.app')

@section('content')
<!-- CHART COMPONENT -->
<div class="container-fluid bg-dark pt-5 pb-5 d-flex flex-column justify-content-center align-items-center">
    <h3 class="text-white text-center p-3 mb-5">{{ $deck->deck_name }} Statistic Analysis</h3>
    <div class="container-fluid row row-md-cols-1 row-lg-cols-2">
        <div class="col-6 chart" id="main_deck_piechart" style="height: 500px;"></div>
        <div class="col-6 chart" id="extra_deck_piechart" style="height: 500px;"></div>
        <div class="col-6 chart" id="side_deck_piechart" style="height: 500px;"></div>
        <div class="col-6 chart" id="total_deck_piechart" style="height: 500px;"></div>
    </div>
    <button class="btn btn-primary"><a href="{{ route('home') }}" style="color: white; text-decoration: none;">Go Back to Dashboard</a></button>
</div>

<!-- GOOGLE PIE CHART FUNCTIONALITY -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    const main_deck_content = "{{ $deck->main_deck }}";

    const extra_deck_content = "{{ $deck->extra_deck }}";

    const side_deck_content = "{{ $deck->side_deck }}";

    const get_type_obj = deck_content => {
        if(deck_content.replace('none', '') != '') {
            let type_arr = [];
            let type_object = {};

            deck_content
                .replaceAll('&lt;', '<').replaceAll('&gt;', '>')
                .replaceAll('<>', '/').split('<separator>').forEach(content => {
                const card_type = content.split('(type)')[1];

                if(card_type) {

                    if(!type_arr.includes(card_type)) {
                        type_arr.push(card_type);
                        type_object[card_type] = 1;
                    } else {
                        type_object[card_type]++;
                    }

                }
            });

            return type_object;
        }

        return null;
    }

    const get_type_arr = type_obj => {
        let type_arr = [['Card Type', 'Quantity']];

        if(type_obj) {
            for (let key in type_obj) {
                const arr = [key, type_obj[key]];
                type_arr.push(arr);
            }

            return type_arr;
        }

        return null;
    };

    /* DECK CONTENTS ON VARIOUS TYPES */
    const main_type_arr = get_type_arr(get_type_obj(main_deck_content));
    const extra_type_arr = get_type_arr(get_type_obj(extra_deck_content));
    const side_type_arr = get_type_arr(get_type_obj(side_deck_content));

    /* DECK CONTENTS IN TOTAL */
    const total_type_arr = get_type_arr(get_type_obj(main_deck_content + extra_deck_content + side_deck_content));

    const draw_pie_chart = (type_arr, id, deck_name) => {

        new_type_arr = (type_arr) ? type_arr : [
            ['Card Type', 'Empty'],
            [`${deck_name} is empty`, 1]
        ];

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable(new_type_arr);

            var options = {
            title: `${deck_name} Statistics`,
            backgroundColor: 'transparent',
            fontColor: 'white',
            titleTextStyle: {
                color: 'white'
            },
            hAxis: {
                textStyle: {
                    color: 'white'
                },
                titleTextStyle: {
                    color: 'white'
                }
            },
            vAxis: {
                textStyle: {
                    color: 'white'
                },
                titleTextStyle: {
                    color: 'white'
                }
            },
            legend: {
                textStyle: {
                    color: 'white'
                }
            }
            };

            var chart = new google.visualization.PieChart(document.getElementById(id));

            chart.draw(data, options);
        }
    }

    // SET TIMER TO AVOID EXECUTING AT THE SAME TIME
    draw_pie_chart(main_type_arr, 'main_deck_piechart', 'Main Deck');

    setTimeout(() => {
        draw_pie_chart(extra_type_arr, 'extra_deck_piechart', 'Extra Deck');
    }, 500);

    setTimeout(() => {
    draw_pie_chart(side_type_arr, 'side_deck_piechart', 'Side Deck');
    }, 1000);

    setTimeout(() => {
    draw_pie_chart(total_type_arr, 'total_deck_piechart', 'Overall Deck');
    }, 1500);
</script>
@endsection