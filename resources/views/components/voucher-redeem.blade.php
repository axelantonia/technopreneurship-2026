@props([
    'compact' => false,
    'subtotal' => 0,
    'onRedeem' => 'voucherRedeemed',  // JS callback name
])

@php
$rewards = [
    ['id' => 'D10',  'name' => 'Diskon Sesi 10%',     'desc' => 'Potongan 10% untuk semua sesi tutor.',                        'poin' => 400,  'type' => 'PERSEN',  'value' => 10],
    ['id' => 'V10',  'name' => 'Voucher Rp10.000',     'desc' => 'Potongan Rp10.000 untuk 1 sesi belajar.',                     'poin' => 800,  'type' => 'NOMINAL', 'value' => 10000],
    ['id' => 'V25',  'name' => 'Voucher Rp25.000',     'desc' => 'Diskon menengah untuk sesi belajar intensif.',                  'poin' => 1400, 'type' => 'NOMINAL', 'value' => 25000],
    ['id' => 'V50',  'name' => 'Voucher Rp50.000',     'desc' => 'Diskon besar untuk kelas intensif / persiapan ujian.',         'poin' => 2200, 'type' => 'NOMINAL', 'value' => 50000],
    ['id' => 'FREE','name' => '1x Sesi Gratis',        'desc' => 'Dapatkan 1 sesi belajar gratis dengan tutor pilihan.',         'poin' => 3000, 'type' => 'NON-DISKON', 'value' => 0],
    ['id' => 'PRIO', 'name' => 'Voucher Prioritas Booking','desc' => 'Prioritas pilih jadwal tutor favorit tanpa antre.',       'poin' => 1800, 'type' => 'NON-DISKON', 'value' => 0],
];

$userPoin = 2450; // TODO: ganti dengan data real dari DB/session
@endphp

<div class="voucher-redeem">
    {{-- Saldo poin --}}
    <div class="flex items-center justify-between mb-4 @if($compact) bg-surface rounded-xl px-4 py-3 border border-secondary @endif">
        <div class="flex items-center gap-2">
            <i class="bi bi-coin text-amber-500 text-lg"></i>
            <span class="text-sm font-bold text-dark">Poin Kamu</span>
        </div>
        <span class="text-lg font-extrabold text-amber-500" id="saldo-poin">{{ number_format($userPoin, 0, ',', '.') }}</span>
    </div>

    {{-- Grid rewards --}}
    <div class="grid @if($compact) grid-cols-1 sm:grid-cols-2 gap-3 @else grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 @endif" id="rewards-grid">
        @foreach($rewards as $rw)
        @php $canRedeem = $userPoin >= $rw['poin']; @endphp
        <div class="@if($compact) bg-white border border-secondary rounded-xl p-3 @else bg-white rounded-3xl border border-blue-100 shadow-sm hover:shadow-lg transition p-6 @endif">
            <div class="flex justify-between items-start @if(!$compact) flex-col @endif">
                <div>
                    <h4 class="@if($compact) text-sm @else text-lg @endif font-extrabold text-dark">{{ $rw['name'] }}</h4>
                    @if(!$compact)
                    <p class="text-gray-500 text-sm mt-1">{{ $rw['desc'] }}</p>
                    @endif
                </div>

                @if($compact)
                <div class="text-right flex-shrink-0 ml-2">
                    <span class="text-amber-500 font-extrabold text-xs flex items-center gap-0.5">
                        <i class="bi bi-coin"></i> {{ number_format($rw['poin'], 0, ',', '.') }}
                    </span>
                </div>
                @endif
            </div>

            <div class="@if(!$compact) mt-6 @else mt-2 @endif flex justify-between items-center">
                @if(!$compact)
                <span class="text-amber-500 font-extrabold flex items-center gap-1">
                    <i class="bi bi-coin"></i> {{ number_format($rw['poin'], 0, ',', '.') }}
                </span>
                @endif
                <button type="button"
                        data-reward-id="{{ $rw['id'] }}"
                        data-reward-type="{{ $rw['type'] }}"
                        data-reward-value="{{ $rw['value'] }}"
                        data-reward-poin="{{ $rw['poin'] }}"
                        data-reward-name="{{ $rw['name'] }}"
                        onclick="redeemReward(this, '{{ $onRedeem }}')"
                        class="btn-redeem text-xs font-bold px-3 py-2 rounded-xl transition-all 
                               @if($canRedeem) bg-primary text-white hover:bg-primary-hover @else bg-gray-100 text-gray-400 cursor-not-allowed @endif"
                        @if(!$canRedeem) disabled @endif>
                    Tukar
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
// ── Alpine.js-like state for poin tracking ──────────────────────────
// Using vanilla JS since the project doesn't use Alpine
let globalUserPoin = {{ $userPoin }};

function redeemReward(btn, callbackName) {
    if (btn.disabled) return;

    const rewardId    = btn.dataset.rewardId;
    const rewardType  = btn.dataset.rewardType;
    const rewardValue = parseInt(btn.dataset.rewardValue);
    const rewardPoin  = parseInt(btn.dataset.rewardPoin);
    const rewardName  = btn.dataset.rewardName;

    if (globalUserPoin < rewardPoin) {
        showToast('Poin kamu tidak mencukupi!', 'warning');
        return;
    }

    // Simulate AJAX redeem (in production: POST /poin/tukar with CSRF)
    const formData = new FormData();
    formData.append('reward_id', rewardId);
    formData.append('_token', '{{ csrf_token() }}');

    // In production, do actual fetch:
    // fetch('/poin/tukar', { method:'POST', body: formData })
    //   .then(r => r.json()).then(data => { ... })

    // For now, simulate success
    globalUserPoin -= rewardPoin;
    document.getElementById('saldo-poin').textContent = globalUserPoin.toLocaleString('id-ID');

    // Call parent callback if exists
    if (window[callbackName]) {
        window[callbackName]({
            rewardId: rewardId,
            rewardType: rewardType,
            rewardValue: rewardValue,
            rewardPoin: rewardPoin,
            rewardName: rewardName,
        });
    }

    // Update all disabled states
    document.querySelectorAll('.btn-redeem').forEach(b => {
        const cost = parseInt(b.dataset.rewardPoin);
        if (globalUserPoin < cost) {
            b.disabled = true;
            b.className = 'btn-redeem text-xs font-bold px-3 py-2 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed';
        }
    });

    if (rewardType === 'NON-DISKON') {
        showToast(`🎉 ${rewardName} berhasil ditukar! Cek di profil kamu.`, 'success');
    } else {
        showToast(`🎉 ${rewardName} berhasil ditukar! Voucher sudah siap digunakan.`, 'success');
    }
}

function voucherRedeemed(data) {
    // This gets called when a PERSEN/NOMINAL reward is redeemed from checkout
    // The parent checkout page handles the dropdown + Ringkasan update
    if (data.rewardType === 'PERSEN') {
        addVoucherToDropdown(data.rewardId, data.rewardName + ' (dari poin)', data.rewardType, data.rewardValue);
    } else if (data.rewardType === 'NOMINAL') {
        addVoucherToDropdown(data.rewardId, data.rewardName + ' (dari poin)', 'flat', data.rewardValue);
    }
}

function addVoucherToDropdown(code, label, type, value) {
    const sel = document.getElementById('voucherSelect');
    if (!sel) return;

    // Check if already exists
    for (let opt of sel.options) {
        if (opt.value === 'redeem-' + code) return;
    }

    const opt = document.createElement('option');
    opt.value = 'redeem-' + code;
    opt.dataset.type = type;
    opt.dataset.val = value;
    opt.text = label;
    opt.selected = true;
    sel.appendChild(opt);

    // Trigger change event
    sel.dispatchEvent(new Event('change'));
}
</script>
@endpush
