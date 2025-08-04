const API = '/api/brand';

function showAlert(type, message) {
    const container = document.getElementById('form-alert');
    container.innerHTML = `
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `;
}

function stars(rating) {
    const r = Math.max(0, Math.min(5, Math.round(rating)));
    let html = '';
    for (let i = 1; i <= 5; i++) {
        html += `<span class="star ${i <= r ? 'filled' : ''}">★</span>`;
    }
    return html;
}

async function loadBrands() {
    const list = document.getElementById('brand-list');
    list.innerHTML = `<div class="brand-row"><div class="col-name">Loading…</div></div>`;

    try {
        const res = await fetch(API);
        const data = await res.json();
        const brands = Array.isArray(data) ? data : (data.items || []);

        if (!brands.length) {
            list.innerHTML = `<div class="brand-row"><div class="col-name">No brands found.</div></div>`;
            return;
        }

        list.innerHTML = brands.map((b, i) => `
            <div class="brand-row">
                <div class="col-rank">${i + 1}</div>
                <div class="col-logo">
                <img src="${b.brand_image}" alt="${b.brand_name}">
                <span class="col-name">${b.brand_name}</span>
                </div>
                <div class="col-rating">${stars(b.brand_rating)}</div>
                <div class="col-bonus">${b.country_code}</div>
                <div class="col-actions">
                <button class="btn--delete" data-id="${b.brand_id}">Delete</button>
                </div>
            </div>
        `).join('');
    } catch {
        list.innerHTML = `<div class="brand-row"><div class="col-name">Error loading brands.</div></div>`;
        showAlert('danger', 'Failed to load brand list.');
    }
}

async function createBrand(e) {
    e.preventDefault();
    const f = e.target;
    const data = {
        brand_name: f.name.value,
        brand_image: f.image.value,
        brand_rating: +f.rating.value,
        country_code: f.country_code.value.toUpperCase(),
    };

    try {
        const res = await fetch(API, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        if (res.ok) {
            showAlert('success', 'Brand created successfully!');
            f.reset();
            loadBrands();
        } else {
            let errText = await res.text();
            try {
                const errJson = JSON.parse(errText);
                if (Array.isArray(errJson)) {
                    errText = errJson.map(e => e.message).join('<br>');
                }
            } catch { }
            showAlert('danger', `Create failed:<br>${errText}`);
        }
    } catch {
        showAlert('danger', 'Network error occurred while creating brand.');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('brand-form').addEventListener('submit', createBrand);
    document.getElementById('brand-list').addEventListener('click', async e => {
        if (e.target.matches('.btn--delete')) {
            try {
                const res = await fetch(`${API}/${e.target.dataset.id}`, { method: 'DELETE' });
                if (res.ok) {
                    showAlert('success', 'Brand deleted.');
                    loadBrands();
                } else {
                    showAlert('danger', 'Delete failed.');
                }
            } catch {
                showAlert('danger', 'Network error on delete.');
            }
        }
    });
    loadBrands();
});