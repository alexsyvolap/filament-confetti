import confetti from 'canvas-confetti';

document.addEventListener('alpine:init', () => {
    Alpine.data('filamentConfetti', ({ sessionData, eventName }) => ({
        init() {
            if (sessionData) this.triggerConfetti(sessionData);
            window.addEventListener(eventName, (event) => {
                let detailData = event.detail && event.detail.length ? event.detail[0] : event.detail;
                this.triggerConfetti(detailData);
            });
        },

        triggerConfetti(customData) {
            if (!customData) return;
            let cleanData = JSON.parse(JSON.stringify(customData));
            if (Array.isArray(cleanData) && Array.isArray(cleanData[0])) cleanData = cleanData[0];
            let shots = Array.isArray(cleanData) ? cleanData : [cleanData];

            shots.forEach((config, index) => {
                let delay = config.delay !== undefined ? config.delay : (index * 50);
                delete config.delay;

                if (config.shapes) {
                    config.shapes = config.shapes.map(shape => {
                        if (typeof shape === 'object' && shape !== null) {
                            if (shape.type === 'path') {
                                return confetti.shapeFromPath({ path: shape.path, matrix: shape.matrix });
                            }
                            if (shape.type === 'text') {
                                return confetti.shapeFromText({ text: shape.text, scalar: shape.scalar });
                            }
                        }
                        return shape;
                    });
                }

                setTimeout(() => {
                    confetti(config).catch(err => {});
                }, delay);
            });
        }
    }));
});
