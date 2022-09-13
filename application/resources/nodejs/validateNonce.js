const Buffer = require('buffer');
const EMS = require('@emurgo/cardano-message-signing-nodejs');

const toHexBuffer = hex => Buffer.Buffer.from(hex, 'hex');
const toHexString = array => Buffer.Buffer.from(array).toString('hex');

const verifyData = (coseSign1, payload) => {
    const coseSign1_verify = EMS.COSESign1.from_bytes(toHexBuffer(coseSign1));
    const signedSigStruc_verify = coseSign1_verify.signed_data();
    return toHexString(signedSigStruc_verify.payload()) === payload;
}

const args = process.argv.slice(2);

console.log(verifyData(args[0], args[1]));
