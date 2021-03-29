<template>
    <canvas style="width: 100%" height="300" ref="waterProduction"></canvas>
</template>

<script>
import Chart from 'chart.js';
export default {
    props: ['labels','values'],
    mounted() {
        var ctx=this.$refs.waterProduction.getContext("2d");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: this.labels,
                datasets: [{
                    label: 'تولید آب سالانه',
                    data:this.values.waterProduction,
                    backgroundColor: 'rgba(52, 152, 219,0.5)',
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
