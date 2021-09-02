class Event {
    constructor(year, month, description) {
        this.year = year
        this.month = month
        this.description = description
    }
}

const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

var app = new Vue({
    el: '#events-app',
    data: {
        currentYear: (new Date()).getFullYear(),
        months: months,
        newEvent: {
            month: months[(new Date()).getMonth()],
            description: '',
        },
        events: [],
    },
    methods: {
        filteredEvents(month, year) {
            return this.events.filter(e => e.month == month && e.year == year);
        },
        changeYear(add) {
            if (add) {
                this.currentYear++;
            } else {
                this.currentYear--;
            }
        },
        deleteEvent(event) {
            let index = false;

            for (let i = 0; i < this.events.length; i++) {
                const element = this.events[i];

                if (element.description == event.description && element.year == event.year && element.month == event.month) {
                    index = i;
                    break;
                }
            }

            if (index >= 0) {
                this.events.splice(index, 1);
            }
        },
        createEvent() {
            if (!this.newEvent.month) {
                alert('Debe ingresar un mes');
                return;
            }
            if (!this.newEvent.description) {
                alert('Debe ingresar un título');
                return;
            }

            this.events.push(new Event(
                this.currentYear,
                this.newEvent.month,
                this.newEvent.description
            ));

            this.newEvent.description = '';
        }
    }
});
