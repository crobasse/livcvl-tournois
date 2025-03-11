class LivState {
  value: any;
  setter: Function;

  constructor(value: any, setter: Function) {
    this.value = value;
    this.setter = setter;
  }
}

export default LivState;
