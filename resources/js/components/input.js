import Autonumeric from "autonumeric";


export default function CitadelInput(el)
{
    if(el.hasClass('.percentage')) {
        new Autonumeric(el, {
            aSep: ',',
            aDec: '.',
            aSign: '',
            mDec: '2',
            vMax: '100'
        })
    }

    if(el.hasClass('.money')) {
        new Autonumeric(el, {
            aSep: '.',
            aDec: ',',
            mDec: '0',
            aSign: ''
        })
    }
} 