const projectFormApp = new Vue({
    el: '#project-form-app',
    name: "ProjectForm",
    data() {
        return {
            videos: window.videos || [],
            images: window.images || [],
            newImages: [],
        }
    },
    methods: {
        addImage() {
            this.newImages.push("");
        },
        removeImage() {
            this.newImages.splice((this.newImages.length - 1), 1);
        },
        removeCurrentImage(index) {
            this.images.splice(index, 1);
        },
        changeFile(e) {
            let fileName = e.target.files[0].name;
            let nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        },
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
            const hasNewImages = this.newImages.length > 0;
            const hasCurrentImages = this.images.length > 0;

            if (hasEmptyVideos) {
                return false;
            }
            if (!hasNewImages && !hasCurrentImages) {
                return false;
            }

            return true;
        }
    }
});
