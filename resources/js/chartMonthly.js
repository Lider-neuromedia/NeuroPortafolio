var Graph = Vue.component('graph', {
    extends: VueChartJs.Line,
    mixins: [VueChartJs.mixins.reactiveProp],
    name: 'Graph',
    data() {
        return {
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 100
                        }
                    }],
                }
            }
        }
    },
    mounted() {
        this.renderChart(this.chartData, this.options)
    }
})

var app = new Vue({
    el: '#monthly-app',
    components: {
        Graph
    },
    data: {
        months: [{
            x: 'Junio',
            y: 10
        }, {
            x: 'Julio',
            y: 27
        }, {
            x: 'Agosto',
            y: 72
        }]
    },
    computed: {
        graphData() {
            let labels = this.months.map((month) => month.x);
            let data = this.months.map((month) => month.y);
            let datasets = [{
                label: 'Conteo',
                data: data,
                fill: true,
                backgroundColor: 'rgba(99, 255, 132, 0.4)',
                borderColor: 'rgba(99, 255, 132, 1)',
                borderWidth: 2,
                tension: 0.5,
            }];

            return {
                labels,
                datasets
            }
        }
    },
    watch: {
        graphData: {
            deep: true,
            handler() {}
        }
    },
    methods: {
        addMonthRow() {
            this.months.push({
                x: 'Sin Nombre',
                y: 0
            });
        },
        removeMonthRow(start) {
            console.log(start)
            this.months.splice(start, 1);
        }
    }
});
