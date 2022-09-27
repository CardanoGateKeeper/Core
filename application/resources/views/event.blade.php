@extends('layouts.app')

@section('content')
    <style media="print">
        #mainContent, #printBtn {
            display: none;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" id="mainContent">
                    <div class="card-header d-flex gap-2 align-items-center">
                        <i class="fa fa-smile-o"></i>
                        {{ __('Welcome to GateKeeper') }}
                        <span class="badge bg-primary">{{ $event->name }}</span>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <p>
                                Please note: for the time being, hardware wallets are not supported due to lack of
                                support for the <a href="https://cips.cardano.org/cips/cip8/" target="_blank" class="alert-link">Cardano CIP-8 Message Signing</a>
                                standard. We always encourage all users to secure their assets on a hardware wallet
                                whenever possible for maximum security.
                            </p>
                            <p class="mb-0">
                                Wallets that do not support the <a href="https://cips.cardano.org/cips/cip30/" target="_blank" class="alert-link">Cardano CIP-30 dApp-Wallet Bridge</a>
                                standard including Daedalus, Yoroi, and AdaLite are not supported.
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <h4 class="alert-heading">How It Works</h4>
                            <p>
                                Welcome to GateKeeper Ticketing, a secure and safe way to convert your Cardano NFTs into
                                tickets to real-world events while keeping your crypto safely at home!
                            </p>
                            <ul>
                                <li>
                                    To get started, you'll be asked to connect your light wallet from one of the
                                    available options below.
                                </li>
                                <li>
                                    Once connected, your eligible assets for this event will be displayed. Find the
                                    token you wish to generate a ticket for and click the "Generate Ticket" button.
                                </li>
                                <li>
                                    You will be asked to "sign" a data payload using the stake key of your wallet to
                                    prove asset ownership. No funds will be moved from your wallet.
                                </li>
                                <li>
                                    After your signature is authenticated, a ticket will be generated for your asset and
                                    a QR code will be displayed on the screen. Save this QR code and bring it with you
                                    to the event!
                                </li>
                                <li>
                                    If you lose your QR code for any reason, you will need to return to this page and
                                    generate a new one.
                                </li>
                                <li>
                                    QR codes can only be used once to check in. If you sell or otherwise transfer your
                                    token (NFT) the new owner may generate their own QR code for the event which will
                                    invalidate your code. We recommend retaining ownership of the asset until after the
                                    event.
                                </li>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div id="wallet-section">
                            <div class="connect-wallet">
                                <p class="text-center">Connect your wallet to get started ...</p>
                                <div class="wallet-options row justify-content-center"></div>
                            </div>
                            <div class="change-wallet">
                                <div
                                    class="connected-wallet d-flex flex-row align-items-center justify-content-center mb-4">
                                    <img class="connected-wallet-icon" alt=""/>
                                    <p class="wallet-info mb-0 mx-2 lead">
                                        <span class="wallet-name text-capitalize"></span> Connected <span
                                            class="wallet-balance badge bg-info text-white p-2 mx-3"></span>
                                    </p>
                                    <button type="button" class="btn check-wallet btn-outline-secondary btn-sm me-3" id="recheckBalance">
                                        <i class="fa fa-refresh"></i>
                                        Recheck Balance
                                    </button>
                                    <button type="button" class="btn change-wallet-btn btn-secondary btn-sm" id="change-wallet-button">
                                        Change Wallet
                                    </button>
                                </div>
                                <div id="asset-container" class="row justify-content-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="TicketModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Here's Your Ticket!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="container-fluid">
                        <div class="row row-cols-lg-2">
                            <div class="col mb-4 text-start">
                                <div class="alert alert-danger mb-4">
                                    <p>
                                        Please save the generated QR code shown here to your phone or print it clearly
                                        on a piece of paper and bring it with you to the event.
                                    </p>
                                    <p>
                                        You should never travel to live events with valuable crypto assets on your
                                        person and NFTs as tickets to events are no exception! Do not share the
                                        information on this screen with anyone else except for when checking in at the
                                        event.
                                    </p>
                                    <p class="mb-0">
                                        Please be aware that you must leave the asset in this same wallet until you have
                                        checked in to the event. If the asset is moved from your wallet prior to the
                                        event it will invalidate your ticket, and you will need to regenerate it.
                                    </p>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="ticketAssetId">Asset ID</label>
                                    <input type="text" class="form-control" readonly id="ticketAssetId"/>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="ticketSecurityCode">Security Code</label>
                                    <input type="text" class="form-control" readonly id="ticketSecurityCode"/>
                                </div>
                                <div class="form-group mb-0" id="printBtn">
                                    <button type="button" class="btn btn-primary" onclick="window.print();">
                                        <i class="fa fa-print"></i> Print Ticket
                                    </button>
                                </div>
                            </div>
                            <div class="col mb-4">
                                <img src="" id="ticketQr" alt="Ticket QR Code" class="img img-thumbnail img-fluid"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.32/sweetalert2.min.js" integrity="sha512-yc+tEbvC4kiy3J6e0aZogFVr8AZhMtJTof2z+fGPaJgjehpIPzguZxfRRTiQcXlSHbJsB3Bborvv++81TMLZ2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.32/sweetalert2.min.css" integrity="sha512-doewDSLNwoD1ZCdA1D1LXbbdNlI4uZv7vICMrzxfshHmzzyFNhajLEgH/uigrbOi8ETIftUGBkyLnbyDOU5rpA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/bridge/cardano-dapp-connector-bridge.min.js') }}"></script>
    <script type="text/javascript" src="//cdn.dripdropz.io/wallet-connector/csl-v10.0.4/bundle.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="module">
        import * as CSL from '//cdn.dripdropz.io/wallet-connector/csl-v10.0.4/init.js';

        (async function ($) {

            const EVENT_UUID = '{{ $event->uuid }}';

            const event = await $.get('{{ route('api.v1.event-info', $event->uuid)}} ');
            const policy_ids = event.data.policyIds;

            // 1 = Mainnet, 0 = Testnet
            const network_mode = 1;

            const protocolParameters = {
                linearFee: {
                    minFeeA: "44",
                    minFeeB: "155381",
                },
                minUtxo: "1000000",
                poolDeposit: "500000000",
                keyDeposit: "2000000",
                maxValSize: "5000",
                maxTxSize: 16384,
                costPerWord: "34482"
            };

            const supported_wallets = [
                'nami',
                'eternl',
                'flint',
                'typhoncip30',
                'gerowallet',
                'LodeWallet',
                'nufi'
            ];

            const connector_section = $('.connect-wallet');
            const wallet_holder = $('.wallet-options');
            const wallet_connected = $('.change-wallet');
            const asset_container = $('#asset-container');
            const change_wallet_button = $('#change-wallet-button');

            const IMAGE_CDN = '{{env('DEFAULT_IMAGE_CDN')}}';
            const IMAGE_URL = '{{env('IMAGE_CDN_URL')}}';

            window.Wallet = false;
            window.Wallets = [];

            // Utility Functions Start
            async function delay(ms) {
                return await new Promise(resolve => setTimeout(resolve, ms));
            }

            function arrayToString(array) {
                var out, i, len, c;
                var char2, char3;

                out = "";
                len = array.length;
                i = 0;
                while (i < len) {
                    c = array[i++];
                    switch (c >> 4) {
                        case 0:
                        case 1:
                        case 2:
                        case 3:
                        case 4:
                        case 5:
                        case 6:
                        case 7:
                            // 0xxxxxxx
                            out += String.fromCharCode(c);
                            break;
                        case 12:
                        case 13:
                            // 110x xxxx   10xx xxxx
                            char2 = array[i++];
                            out += String.fromCharCode(((c & 0x1F) << 6) | (char2 & 0x3F));
                            break;
                        case 14:
                            // 1110 xxxx  10xx xxxx  10xx xxxx
                            char2 = array[i++];
                            char3 = array[i++];
                            out += String.fromCharCode(((c & 0x0F) << 12) |
                                ((char2 & 0x3F) << 6) |
                                ((char3 & 0x3F) << 0));
                            break;
                    }
                }

                return out;
            }

            function toHex(bytes) {
                return Buffer.Buffer.from(bytes).toString('hex');
            }

            function toUint8Array(cbor) {
                return Uint8Array.from(Buffer.Buffer.from(cbor, 'hex'));
            }

            const showError = (message) => {
                Swal.fire({
                    icon: 'error',
                    html: `<span class="text-danger">${message}</span>`,
                    showConfirmButton: true,
                    confirmButtonText: 'Okay',
                    allowOutsideClick: false,
                });
            };

            function getAssetImageUrl(asset) {
                if (IMAGE_CDN === 'nftcdn') {
                    return `//${asset.fingerprint}.${IMAGE_URL}/?size=312`;
                }

                return `${IMAGE_URL}/${asset.onchain_metadata.image.replace('ipfs://','')}`;
            }

            // Utility Functions End

            async function fetchMetadata() {
                if (!window.Wallet.assets) {
                    return;
                }

                for (const [id, details] of Object.entries(window.Wallet.assets)) {
                    let choice_exists = asset_container.find(`#${id}`).length;
                    if (choice_exists) {
                        continue;
                    }

                    let metadata = undefined;
                    let asset_details = null;

                    if (details !== null) {
                        metadata = details.onchain_metadata;
                        asset_details = details;
                    } else {
                        let meta = JSON.parse(window.localStorage.getItem(id));
                        if (meta === null) {
                            let ts = performance.now();
                            meta = await $.post('{{ route('api.v1.asset-info') }}', {
                                asset_id: id
                            }).fail(async () => {
                                await delay(2000);
                                return fetchMetadata();
                            });
                            let te = performance.now();
                            let delay_t = 600 - (te - ts);
                            if (delay_t > 0) {
                                await delay(delay_t);
                            }
                            asset_details = meta.data;
                            window.localStorage.setItem(id, JSON.stringify(asset_details));
                            metadata = asset_details.onchain_metadata;
                        }
                        window.Wallet.assets[id] = meta;
                    }

                    if (asset_details === null) {
                        continue;
                    }

                    choice_exists = asset_container.find('#' + id).length;

                    let shouldLazy = asset_container.find('.col-md-3').length;
                    let lazy = 'data-';
                    if (shouldLazy < 12) {
                        // Don't lazy load the first 12 images...
                        lazy = '';
                    }

                    if (choice_exists === 0 && metadata !== null) {
                        const img_url = getAssetImageUrl(asset_details);

                        // console.log(asset_details);
                        const asset = `
                            <div class="col-md-3">
                                <div class="card mb-3" id="${id}">
                                    <img ${lazy}src="${img_url}" class="card-img-top lazy" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">${metadata.name}</h5>
                                        <button type="button" class="btn btn-primary col-12 btn-generate" data-policy="${asset_details.policy_id}" data-asset="${asset_details.asset_name}">
                                            <span class="fa fa-qrcode"></span>
                                            Generate Ticket
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;

                        asset_container.append(asset);
                    }
                }
                $('.lazy').Lazy();
                Swal.close();
            }

            async function checkContents() {
                try {
                    let wallet_contents = await window.Wallet.getBalance();
                    return CSL.Value.from_bytes(toUint8Array(wallet_contents));
                } catch (e) {
                    showError("Sorry, we couldn't check your wallet balance at this time.");
                    console.error(e);
                }
            }

            async function hasNFTs(balance) {
                const walletAssets = {};
                if (balance === undefined || balance.multiasset() === undefined) {
                    return walletAssets;
                }

                const multiasset = balance.multiasset();
                const numAssets = multiasset.keys().len();
                for (let i = 0; i < numAssets; i++) {
                    const policycbor = multiasset.keys().get(i);
                    const policyId = toHex(policycbor.to_bytes());
                    if (!policy_ids.includes(policyId)) {
                        continue;
                    }

                    const assets = multiasset.get(policycbor);
                    for (let ii = 0; ii < assets.keys().len(); ii++) {
                        const assetName = assets.keys().get(ii);
                        const readableAssetName = arrayToString(assetName.name());
                        const asset_id = policyId + toHex(readableAssetName);
                        window.Wallet.assets[asset_id] = JSON.parse(window.localStorage.getItem(asset_id));
                    }
                }

                return window.Wallet.assets;
            }

            async function connectWallet(evt) {
                window.Wallet = undefined;

                evt.preventDefault();
                evt.stopPropagation();

                let wallet_name = evt.currentTarget.dataset.wallet;
                await connect(wallet_name);
            }

            async function checkBalance() {
                Swal.showLoading();

                const connected_bal = $('.wallet-balance');
                const wallet_balance = await checkContents();
                const nfts = await hasNFTs(wallet_balance);

                connected_bal.html(`${Object.keys(nfts).length} eligible assets found`)
            }

            async function connect(wallet_name) {
                Swal.showLoading();

                let wallet = window.cardano[wallet_name];

                try {
                    window.Wallet = await wallet.enable();
                    if (window.Wallet !== undefined) {
                        window.Wallet.assets = {};
                        let connected_img = $('.connected-wallet-icon');
                        let connected_name = $('.wallet-name');

                        connected_img.attr('src', wallet.icon);
                        connected_img.attr('alt', wallet.name);
                        connected_img.attr('title', wallet.name);
                        connected_name.html(wallet.name);

                        await checkBalance();

                        connector_section.hide();
                        wallet_connected.show();
                        fetchMetadata();
                    }
                } catch (err) {
                    showError(err.message || 'Failed to connect to wallet')
                }
            }

            function changeWallet() {
                window.Wallet = undefined;
                wallet_connected.hide();
                connector_section.show();
                asset_container.html('');
            }

            async function generateTicket(evt) {
                Swal.showLoading();

                try {
                    const reward_addresses = await window.Wallet.getRewardAddresses();
                    const stake_address_cbor = reward_addresses[0];
                    const stake_key = CSL.Address.from_bytes(toUint8Array(stake_address_cbor));
                    const stake_bech32 = stake_key.to_bech32('stake');

                    // TODO: Insert recaptcha here to prevent API abuse!!!
                    const policy_id = evt.currentTarget.dataset.policy;
                    const asset_id = evt.currentTarget.dataset.asset;

                    $.post('{{route('api.v1.generate-nonce')}}', {
                        event_uuid: EVENT_UUID,
                        stake_key: stake_bech32,
                        policy_id: policy_id,
                        asset_id: asset_id
                    }).then(async (response) => {
                        if (response.data.nonce) {
                            await signNonce(stake_address_cbor, response.data.nonce, policy_id, asset_id);
                        }
                    }).fail(err => showError(err.responseJSON.error || "Sorry, we've encountered an unexpected error!"));
                } catch (err) {
                    showError(err.message || 'Failed to generate ticket');
                }

                Swal.close();
            }

            async function signNonce(stake_address_cbor, nonce, policy_id, asset_id) {
                Swal.showLoading();

                try {
                    const payload = await window.Wallet.signData(stake_address_cbor, nonce);
                    const stake_key = CSL.Address.from_bytes(toUint8Array(stake_address_cbor));
                    const stake_bech32 = stake_key.to_bech32('stake');
                    $.post('{{route('api.v1.validate-nonce')}}', {
                        event_uuid: EVENT_UUID,
                        stake_key: stake_bech32,
                        policy_id: policy_id,
                        asset_id: asset_id,
                        signature: payload.signature,
                        key: payload.key
                    }).then(async (response) => {
                        $('#ticketAssetId').val(response.data.assetId);
                        $('#ticketSecurityCode').val(response.data.securityCode);
                        $('#ticketQr').attr('src', response.data.qr);
                        $('#TicketModal').modal('show');
                    }).fail(err => showError(err.responseJSON.error || "Sorry, there was an error signing the request!"));
                } catch (err) {
                    showError(err.message || 'Failed to capture signature');
                }

                Swal.close();
            }

            async function run() {
                let retries = 10;
                let has_cardano = false;

                connector_section.hide();

                let x = setInterval(function () {
                    if (retries === 0) {
                        clearInterval(x);
                        return;
                    }

                    if (window.self !== window.top) {
                        initCardanoDAppConnectorBridge(async (walletApi) => {
                            if (walletApi.name === 'eternl') {
                                clearInterval(x);
                                await connect(walletApi.name);
                                change_wallet_button.hide();
                            }
                        });

                        return;
                    }

                    if (!window.cardano) {
                        retries--;
                        return;
                    }

                    if (!has_cardano) {
                        connector_section.show();
                        has_cardano = true;
                        $(document).on('click', '#recheckBalance', checkBalance);
                        $(document).on('click', '.connect-btn', connectWallet);
                        $(document).on('click', '.change-wallet-btn', changeWallet);
                        $(document).on('click', '.btn-generate', generateTicket);
                        $(document).on('hidden.bs.modal', '#TicketModal', () => {
                            $('#ticketQr').attr('src', '');
                            $('#ticketAssetId').val('');
                            $('#ticketSecurityCode').val('');
                        });
                    }

                    supported_wallets.forEach(function (wallet) {
                        if (window.Wallets.includes(wallet)) {
                            return;
                        }

                        if (window.cardano[wallet] === undefined) {
                            return;
                        }

                        const btn = `
                            <div class="col-auto text-center">
                                <button type="button" class="btn connect-btn" data-wallet="${wallet}">
                                    <img src="${window.cardano[wallet].icon}" alt="${window.cardano[wallet].name}" />
                                </button>
                            </div>
                        `;

                        wallet_holder.append(btn);
                        window.Wallets.push(wallet);
                    });
                    retries--;
                }, 250);
            }

            $(document).ready(function () {
                run();
            });

        })(jQuery);
    </script>
@endpush
