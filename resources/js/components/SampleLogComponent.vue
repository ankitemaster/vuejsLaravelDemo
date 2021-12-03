<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <h2>Activity Feed</h2>
            <div class="activity-feed">
                <div v-for="(item, index) of activityLogs" :key="index" class="feed-item">
                    <div class="date" style="">{{ item.time_ago }} by {{ item.causer.name }}</div>
                    <div class="text">
                        <p style="font-size: 26px;font-weight: 500;">{{ item.description }}</p>
                    </div>
                    <div class="text">
                        {{ item.properties.customProperty }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'sample-logs',
        data() {
            return {
                activityLogs: []
            }
        },
        methods: {
            seeSampleActivityLogs() {
                axios.get('/api/samples/seeSampleActivityLogs/'+this.$route.params.id).then((res) => {
                    this.activityLogs = res.data.data;
                });
            }
        },
        created() {
            this.seeSampleActivityLogs();
        }
    }
</script>
<style scoped>
    .activity-feed {
        padding: 15px;
    }
    .activity-feed .feed-item {
    position: relative;
    padding-bottom: 20px;
    padding-left: 30px;
    border-left: 2px solid #e4e8eb;
    }
    .activity-feed .feed-item:last-child {
    border-color: transparent;
    }
    .activity-feed .feed-item:after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    left: -6px;
    width: 10px;
    height: 10px;
    border-radius: 6px;
    background: #fff;
    border: 1px solid #f37167;
    }
    .activity-feed .feed-item .date {
    position: relative;
    top: -5px;
    color: #8c96a3;
    text-transform: uppercase;
    font-size: 13px;
    }
    .activity-feed .feed-item .text {
    position: relative;
    top: -3px;
    }
</style>

