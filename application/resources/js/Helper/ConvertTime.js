import { format, parseISO } from "date-fns"
import { id } from 'date-fns/locale';
export default {
    methods: {
        converttime(date) {
            const str = format(
                new Date(date),
                'dd-MMMM-yyyy HH:mm:ss', { locale: id }
            );
            return str;
        },
    }
};
