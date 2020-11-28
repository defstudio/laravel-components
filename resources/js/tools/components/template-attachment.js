$(document).on('click', '.template-attachment-modal .template-attachment-download-button', function () {
    const $button = $(this);
    const url = $button.data('url');
    const columns = $button.data('columns');

    axios.post(url, {columns: columns}, {responseType: 'blob'})
        .then(response => axios.download(response))
        .catch(error => axios.handle(error))
});
