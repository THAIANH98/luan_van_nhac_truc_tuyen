@extends('admin.main')
@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
@endsection
@section('content')
{{--    <button class="btn btn-primary">--}}
{{--        <a href="/admin/training">--}}
{{--            Training--}}
{{--        </a>--}}
{{--    </button>--}}
    <div class="container">
{{--        @include('admin.alert')--}}
        <canvas id="songchart"></canvas>
        <canvas id="playlistchart"></canvas>
    </div>

@endsection
@section('footer')
    <script>
        let songchart = document.getElementById('songchart').getContext('2d');
        // Global Options
        Chart.defaults.global.defaultFontFamily = 'Lato';
        Chart.defaults.global.defaultFontSize = 15;
        Chart.defaults.global.defaultFontColor = '#777';

        let mass_songchart = new Chart(songchart, {
            type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data:{
                labels:[
                    @foreach($top10song as $song)
                        '{{$song->name}}',
                    @endforeach
                ],
                datasets:[{
                    label:'Lượt nghe bài hát',
                    data:[
                        @foreach($top10song as $song)
                            '{{$song->view}}',
                        @endforeach
                    ],
                    //backgroundColor:'green',
                    backgroundColor:[
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)'
                    ],
                    borderWidth:1,
                    borderColor:'#777',
                    hoverBorderWidth:2,
                    hoverBorderColor:'#000'
                }]
            },
            options:{
                title:{
                    display:true,
                    text:'Bài hát nghe nhiều nhất ',
                    fontSize:30
                },
                legend:{
                    display:true,
                    position:'right',
                    labels:{
                        fontColor:'#000'
                    }
                },
                layout:{
                    padding:{
                        left:50,
                        right:0,
                        bottom:0,
                        top:0
                    }
                },
                tooltips:{
                    enabled:true
                }
            }
        });


        let playlistchart = document.getElementById('playlistchart').getContext('2d');
        // Global Options
        Chart.defaults.global.defaultFontFamily = 'Lato';
        Chart.defaults.global.defaultFontSize = 15;
        Chart.defaults.global.defaultFontColor = '#4b4b4b';

        let mass_playlistchart= new Chart(playlistchart, {
            type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data:{
                labels:[
                    @foreach($top10playlist as $song)
                        '{{$song->name}}',
                    @endforeach
                ],
                datasets:[{
                    label:'Lượt nghe playlist',
                    data:[
                        @foreach($top10playlist as $song)
                            '{{$song->view}}',
                        @endforeach
                    ],
                    //backgroundColor:'green',
                    backgroundColor:[
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)'
                    ],
                    borderWidth:1,
                    borderColor:'#777',
                    hoverBorderWidth:2,
                    hoverBorderColor:'#000'
                }]
            },
            options:{
                title:{
                    display:true,
                    text:'Playlist nghe nhiều nhất',
                    fontSize:30,
                },
                legend:{
                    display:true,
                    position:'right',
                    labels:{
                        fontColor:'#000'
                    }
                },
                layout:{
                    padding:{
                        left:20,
                        right:0,
                        bottom:0,
                        top:0
                    }
                },
                tooltips:{
                    enabled:true
                }
            }
        });
    </script>

@endsection
