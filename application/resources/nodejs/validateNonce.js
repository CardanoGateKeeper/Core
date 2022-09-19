const EMS = require('@emurgo/cardano-message-signing-nodejs');
const CSL = require('@emurgo/cardano-serialization-lib-nodejs');
const Buffer = require('buffer');
const cbor = require('cbor');

const toHexBuffer = hex => Buffer.Buffer.from(hex, 'hex');
const toHexString = array => Buffer.Buffer.from(array).toString('hex');

const sigKeyToPublicKey = (sig_key) => {
    const decoded = cbor.decode(sig_key);
    return CSL.PublicKey.from_bytes(toHexBuffer(decoded.get(-2)));
}

const publicKeyToStakeKey = (publicKey) => {
    const stake_arg = `e1` + toHexString(publicKey.hash('hex').to_bytes());
    return CSL.Address.from_bytes(toHexBuffer(stake_arg));
}

const verifyData = (sig_cbor, key, payload, stake_address) => {
    const publicKey = sigKeyToPublicKey(key);
    const stakeAddr = publicKeyToStakeKey(publicKey);
    const coseSign1_verify = EMS.COSESign1.from_bytes(toHexBuffer(sig_cbor));
    const signedSigStruc_verify = coseSign1_verify.signed_data();
    const sig = CSL.Ed25519Signature.from_bytes(coseSign1_verify.signature());

    const walletMatches = stakeAddr.to_bech32('stake') === stake_address;

    const validates = publicKey.verify(signedSigStruc_verify.to_bytes(), sig);

    const payloadMatches = toHexString(signedSigStruc_verify.payload()) === payload;

    return walletMatches && payloadMatches && validates;
}


const args = process.argv.slice(2);

console.log(verifyData(args[0], args[1], args[2], args[3]));
