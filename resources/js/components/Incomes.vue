<template>
    <canvas style="width: 100%" height="300" ref="incomes"></canvas>
</template>

<script>
import Chart from 'chart.js';
export default {
    props: ['labels','values'],
    mounted() {
        var ctx=this.$refs.incomes.getContext("2d");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: this.labels,
                datasets: [{
                    label: 'عواید سالانه',
                    data: this.values.income,
                    backgroundColor:'rgba(142, 68, 173,0.5)' ,
                    borderColor: 'rgba(230, 126, 34,1.0)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    }
}
</script>
