const briefFormApp = new Vue({
    el: '#brief-form-app',
    data() {
        return {
            brief: window.brief || null,
            types: window.types || [],
        }
    },
    methods: {
        addQuestion() {
            this.brief.questions.push({
                brief_id: this.brief.id,
                id: null,
                options: null,
                question: "",
                type: "abierta"
            });
        },
        addOption(index) {
            this.brief.questions[index].options.push("");
        },
        removeQuestion(index) {
            this.brief.questions.splice(index, 1);
        },
        removeOption(questionIndex, optionIndex) {
            this.brief.questions[questionIndex].options.splice(optionIndex, 1);
        },
        move(index, isUp) {
            const currentIndex = index;
            let item = this.brief.questions[index];
            let itemsTemporal = JSON.parse(JSON.stringify(this.brief.questions));

            if (isUp && currentIndex > 0) {
                const previousIndex = currentIndex - 1;
                itemsTemporal.splice(currentIndex, 1);
                itemsTemporal.splice(previousIndex, 0, item);
            } else if (!isUp && currentIndex < (this.brief.questions.length - 1)) {
                const nextIndex = currentIndex + 1;
                itemsTemporal.splice(currentIndex, 1);
                itemsTemporal.splice(nextIndex, 0, item);
            }

            this.brief.questions = itemsTemporal;
        },
    },
    computed: {
        canSave() {
            let validation = true;
            const hasNoOptions = this.brief.questions.filter((x) => x.type != 'abierta' && x.options.length == 0).length > 0;
            const hasNoDescriptions = this.brief.questions.filter((x) => x.question.trim() == "").length > 0;
            const hasNoQuestions = this.brief.questions.length == 0;

            this.brief.questions.forEach(function (question) {
                if (question.type != 'abierta') {
                    const hasEmptyOptions = question.options.filter((x) => x.trim() == "").length > 0;

                    if (hasEmptyOptions) {
                        validation = false;
                    }
                }
            });

            if (hasNoQuestions || hasNoDescriptions || hasNoOptions) {
                validation = false;
            }

            return validation;
        }
    },
    watch: {
        "brief.questions": {
            deep: true,
            handler: function (newValue, oldValue) {
                for (let i = 0; i < this.brief.questions.length; i++) {
                    if (this.brief.questions[i].options == null) {
                        this.brief.questions[i].options = [];
                    }
                    if (this.brief.questions[i].type == 'abierta' && this.brief.questions[i].options.length > 0) {
                        this.brief.questions[i].options = [];
                    }
                }
            },
        }
    }
});
