import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import 'filepond-plugin-get-file/dist/filepond-plugin-get-file.css';
import * as FilePond from "filepond";
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginGetFile from 'filepond-plugin-get-file';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';


FilePond.registerPlugin(FilePondPluginImagePreview,
    FilePondPluginImageExifOrientation,
    FilePondPluginFileValidateSize,
    FilePondPluginGetFile,
    FilePondPluginFileValidateType
);

export default function CitadelFileUpload(el) {
    init(el)
}

function init($el) {
    const server = $el.data('server') || {};
    const config = $el.data('config') || {};
    const filepond = FilePond.create($el[0], {
        name: $el.attr('name'),
        allowMultiple: config.multiple,
        maxFileSize: config.max_size || '100MB',
        allowGetFile: true,
        allowDrop:true,
        allowRemove:config.allowremove,
        labelMaxFileSizeExceeded: 'File too large',
        labelMaxFileSize: 'Maximum file size is {filesize}',
        acceptedFileTypes: config.accepted_file_types,
        labelFileTypeNotAllowed: config.labels_file_type_not_allowed,
        fileValidateTypeLabelExpectedTypes: config.accepted_file_labels,
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
                        const response = JSON.parse(request.responseText);
                        load(response.location_id); // sesuaikan dengan FilePond
                        console.log(response.location_id);
                    } else {
                        error('Upload failed');
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
    });

}
