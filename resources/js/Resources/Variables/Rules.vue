<script>
const regex = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}/gm;

export default {


    text30: [
        v => !!v || 'Este dato es necesario',
        v => (v && v.length > 1) || 'Debe tener más de 1 carácter/es',
        v => (v && v.length < 30) || 'Debe tener máximo 30 carácteres',
    ],
    text50: [
        v => !!v || 'Este dato es necesario',
        v => (v && v.length > 1) || 'Debe tener más de 1 carácter/es',
        v => (v && v.length < 50) || 'Debe tener máximo 50 carácteres',
    ],
    text100: [
        v => !!v || 'Este dato es necesario',
        v => (v && v.length > 1) || 'Debe tener más de 1 carácter/es',
        v => (v && v.length < 100) || 'Debe tener máximo 100 carácteres',
    ],
    text120: [
        v => !!v || 'Este dato es necesario',
        v => (v && v.length > 1) || 'Debe tener más de 1 carácter/es',
        v => (v && v.length < 120) || 'Debe tener máximo 120 carácteres',
    ],
    text200: [
        v => !!v || 'Este dato es necesario',
        v => (v && v.length > 1) || 'Debe tener más de 1 carácter/es',
        v => (v && v.length < 200) || 'Debe tener máximo 200 carácteres',
    ],


    InputTextRules: [
        v => !!v || 'Este dato es necesario',
        v => (v && v.length > 1) || 'Debe tener al menos 1 carácter/es',
    ],

    SelectorRules: [
        v => !!v || 'Es necesario que seleccione una opción',
    ],

    Phone: [
        v => !!v || 'Este campo es necesario',
        v => (v && v.length > 11) || 'Debe tener 10 carácteres',
    ],

    RFC: [
        v => !!v || 'Este campo es necesario',
        v => (v && v.length > 11) || 'Debe tener 10 carácteres',
    ],

    image_short: [
        v => !v || !v.length || v[0].size < 2000000 || 'El peso de la imagen no debe exceder 2 MB!'
    ],

    image_medium: [
        v => !v || !v.length || v[0].size < 5000000 || 'El peso de la imagen no debe exceder 5 MB!'
    ],

    image_long: [
        v => !!v || 'Este campo es necesario',
        v => !v || !v.length || v[0].size < 10000000 || 'El peso de la imagen no debe exceder 10 MB!'
    ],


    pattern: [
        v => !v || !v.length || v[0].size < 10000000 || 'El peso de la imagen no debe exceder 10 MB!'
    ],


    url: [

        v => (v && v.length > 1) || 'Debe tener más de 1 carácter/es',
        v => (v && v.length < 120) || 'Debe tener máximo 120 carácteres',
        v => {
            const regex = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}/gm
            return regex.test(v) || 'Debe de ser una URL Válida'
        },
    ],

    // async validate(forms) {
    //     const {valid} = await forms.validate()
    //     return valid;
    // },
}
</script>

