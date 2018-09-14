<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Movie Title to IMDB Converter</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<div id="app">
    <main class="container mb-4 mt-4" role="main">
        @if($results)
            <div class="card mb-4">
                <div class="card-header">
                    <span class="lead">Results</span>
                </div>
                    <table class="table table-striped">
                        <tr>
                            <th scope="col">Query</th>
                            <th scope="col">Result</th>
                        </tr>
                        @foreach($results as $title)
                            <tr>
                                <td>{{ $title['query'] }}</td>
                                <td>
                                    <select>
                                        @foreach($title['results'] as $result)
                                            <option value="{{ $result->imdbID }}">
                                                {{ $result->Title }} - {{ $result->imdbID }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </table>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <span class="lead">CSV Options</span>
                </div>
                <div class="card-body">
                    <form>
                        <button type="button" class="btn btn-primary mb-2" onclick="generateCsv()">Generate CSV</button>
                        <div class="form-group">
                            <textarea class="form-control" id="csvOutput" rows="10"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="card mb-4">
                <div class="card-header">
                    <span class="lead">Movie Title to IMDB Converter</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('search') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputTitles">Enter a list of movie titles below, separated by a new line:</label>
                            <textarea class="form-control" id="inputTitles" name="titles" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        @endif
    </main>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script>
    function generateCsv() {
        let output = "const,description\r\n";
        $('select').each(function () {
            output += this.value + ",\r\n";
        });

        $('#csvOutput').val(output);
    }
</script>
</body>
</html>
