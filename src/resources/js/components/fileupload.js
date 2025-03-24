import 'filepond/dist/filepond.min.css';
import * as FilePond from "filepond";

export default function CitadelFileUpload(el) {
    init(el)
}

function init($el) {
    const server = $el.data('server') || {};
    const config = $el.data('config') || {};
    const filepond = FilePond.create($el[0], {
        name: $el.attr('name'),
        allowMultiple: config.multiple,
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                const formData = new FormData();
                formData.append('file', file, file.name);

                const request = new XMLHttpRequest();
                request.open('POST', server.process);
                request.upload.onprogress = (e) => {
                    progress(e.lengthComputable, e.loaded, e.total);
                };

                request.onload = function () {
                    if (request.status >= 200 && request.status < 300) {
                        load(request.responseText);
                    } else {
                        error('oh no');
                    }
                };

                request.send(formData);

                return {
                    abort: () => {
                        request.abort();
                        abort();
                    },
                };
            },
            load: server.load
        },
        files: $el.data('files')
    })

}
