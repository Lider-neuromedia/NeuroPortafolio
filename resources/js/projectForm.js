const projectFormApp = new Vue({
    el: '#project-form-app',
    name: "ProjectForm",
    data() {
        return {
            videos: window.videos || [],
        }
    },
    methods: {
        addVideo() {
            this.videos.push({
                path: "",
            });
        },
        removeVideo(index) {
            this.videos.splice(index, 1);
        },
    },
    computed: {
        canSave() {
            const hasEmptyVideos = this.videos.filter((x) => x.path.trim() == '').length > 0;

            if (hasEmptyVideos) {
                return false;
            }

            return true;
        }
    }
});
