# Movie Title to IMDb Converter

A basic web interface that can be used to convert a list of movie titles into IMDb IDs.

Output designed to be used with
[Neinei0k's IMDB List Importer](https://gist.github.com/Neinei0k/f26fc3c0f0aad6a78c308c9589f0c72a).

# Notable Configuration

An [OMDb API](https://www.omdbapi.com/) key is required.

# Known Issues

Due to limitations with the OMDb API, the application does not handle any failures when retrieving information from the
OMDb API (which will normally occur with larger data sets). All results from the OMDb API are cached for 24 hours, so
you can retry the same request with the same data, and the server will continue where it left off.

## License

Licensed under the [MIT license](https://opensource.org/licenses/MIT).
