export type CitadelSpinner<JQuery, T> = (target: JQuery, config: SpinnerConfig) => Object;

export interface SpinnerConfig {
    overlayBackgroundColor: string,
	overlayOpacity: number,
	spinnerIcon: string,
	spinnerColor: string,
	spinnerSize: string,
	overlayIDName: string,
	spinnerIDName: string,
	offsetY: number,
	offsetX: number,
	lockScroll: boolean,
	containerID: null|string,
}