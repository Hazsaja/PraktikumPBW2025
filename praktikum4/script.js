document.addEventListener('DOMContentLoaded', () => {
    const inputUang = document.getElementById('uangDibayar');
    const inputKembalian = document.getElementById('kembalian');
    const rawTotalInput = document.getElementById('rawGrandTotal');

    if (inputUang && inputKembalian && rawTotalInput) {
        inputUang.addEventListener('change', (e) => {
            const uang = parseFloat(e.target.value);
            const rawTotal = parseFloat(rawTotalInput.value);

            if (!isNaN(uang) && uang >= rawTotal) {
                const kembalian = uang - rawTotal;
                // Format angka ke format Rupiah Indonesia
                inputKembalian.value = "Rp " + new Intl.NumberFormat('id-ID').format(kembalian);
                inputKembalian.style.color = "#2E7D32"; 
                inputKembalian.style.fontWeight = "bold";
            } else if (uang < rawTotal) {
                alert("Uang yang dibayarkan tidak cukup!");
                inputKembalian.value = "";
            }
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && e.target.tagName === 'INPUT') {
            e.preventDefault(); 
            if (e.target.id === 'uangDibayar') {
                e.target.blur(); 
            } else {
                const tombolTambah = document.querySelector('.enterinput');
                if (tombolTambah) {
                    tombolTambah.click();
                }
            }
        }
    });

    const modal = document.getElementById('printmodel');
    const openBtn = document.getElementById('openbtn');
    const closeBtn = document.querySelector('.close-btn');

    if (openBtn && modal) {
        openBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });
    }

    if (closeBtn && modal) {
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});