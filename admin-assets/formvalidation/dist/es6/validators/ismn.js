export default function ismn() {
    return {
        validate(input) {
            if (input.value === '') {
                return {
                    meta: null,
                    valid: true,
                };
            }
            let tpe;
            switch (true) {
                case /^M\d{9}$/.test(input.value):
                case /^M-\d{4}-\d{4}-\d{1}$/.test(input.value):
                case /^M\s\d{4}\s\d{4}\s\d{1}$/.test(input.value):
                    tpe = 'ISMN10';
                    break;
                case /^9790\d{9}$/.test(input.value):
                case /^979-0-\d{4}-\d{4}-\d{1}$/.test(input.value):
                case /^979\s0\s\d{4}\s\d{4}\s\d{1}$/.test(input.value):
                    tpe = 'ISMN13';
                    break;
                default:
                    return {
                        meta: null,
                        valid: false,
                    };
            }
            let v = input.value;
            if ('ISMN10' === tpe) {
                v = `9790${v.substr(1)}`;
            }
            v = v.replace(/[^0-9]/gi, '');
            let sum = 0;
            const length = v.length;
            const weight = [1, 3];
            for (let i = 0; i < length - 1; i++) {
                sum += parseInt(v.charAt(i), 10) * weight[i % 2];
            }
            sum = 10 - sum % 10;
            return {
                meta: {
                    type: tpe,
                },
                valid: `${sum}` === v.charAt(length - 1),
            };
        },
    };
}
