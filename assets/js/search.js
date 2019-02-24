const client = algoliasearch(algoliaConfig.application_id, algoliaConfig.search_only_api_key);
const index = client.initIndex(algoliaConfig.index_name);

autocomplete('#searchinput', { hint: false }, [
  {
    source: autocomplete.sources.hits(index, { hitsPerPage: 5 }),
    displayKey: 'name',
    templates: {
      suggestion(suggestion) {
        return suggestion._highlightResult.title.value;
      },
    },
  },
]).on('autocomplete:selected', (event, suggestion, dataset) => {
  window.location = suggestion.url
});

autocomplete('#searchinputmobile', { hint: false }, [
  {
    source: autocomplete.sources.hits(index, { hitsPerPage: 5 }),
    displayKey: 'name',
    templates: {
      suggestion(suggestion) {
        return suggestion._highlightResult.title.value;
      },
    },
  },
]).on('autocomplete:selected', (event, suggestion, dataset) => {
  window.location = suggestion.url
});