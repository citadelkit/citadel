import { Toast } from "bootstrap";
import 'toastr/build/toastr.min.css'; 

export default function CitadelToast(response)
{
    showToastsFromResponse(response)
}

function showToastsFromResponse(response) {
    const toastContainer = document.getElementById('toast-container') || createToastContainer();

    (response.toast || []).forEach((toastData) => {
        const { text, body, options = {} } = toastData;

        const toastEl = document.createElement('div');
        toastEl.className = 'toast align-items-center text-bg-' + (mapType(options.type) || 'primary');
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');

        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <strong>${text}</strong><br>
                    ${body}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

        toastContainer.appendChild(toastEl);

        const toast = new bootstrap.Toast(toastEl, {
            autohide: true,
            delay: (options.autohide || options.autoclose || 5) * 1000, // fallback default 5 detik
        });

        toast.show();
    });
}

function mapType(type) {
    switch (type) {
        case 'success': return 'success';
        case 'error': return 'danger';
        case 'info': return 'info';
        case 'warning': return 'warning';
        default: return 'primary';
    }
}

function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'toast-container position-fixed top-0 end-0 p-3';
    document.body.appendChild(container);
    return container;
}
