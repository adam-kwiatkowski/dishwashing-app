<template>
  <fieldset data-quantity="">
    <button
      type="button"
      title="Down"
      class="sub"
      id="sub"
      @click="changeValue(-step)"
    >
      Down
    </button>
    <input
      type="number"
      name="quantity"
      :step="step"
      :min="min"
      :max="max"
      id="quantity"
      required
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <button
      type="button"
      title="Up"
      class="add"
      id="add"
      @click="changeValue(+step)"
    >
      Up
    </button>
  </fieldset>
</template>

<script>
export default {
    props: {
        step: {
            type: Number,
            default: 1,
        },
        min: {
            type: Number,
            default: 0,
        },
        max: {
            type: Number,
            default: Infinity,
        },
        modelValue: {
            type: Number,
            default: 1,
        },
    },
    emits: ["update:modelValue"],
    methods: {
        changeValue(n) {
            if (
                +this.modelValue + n >= this.min &&
                +this.modelValue + n <= this.max
            ) {
                this.$emit("update:modelValue", +this.modelValue + n);
            }
        },
    },
};
</script>

<style>
[data-quantity] {
  position: relative;
  width: 100%;
  max-width: 11rem;
  padding: 0;
  margin: 30px 0;
  border: 0;
}

[data-quantity] input {
  font-size: 18px;
  height: 4rem;
  /* padding: 0 0rem; */
  border-radius: 2rem;
  border: 1px solid #eee;
  background: #fff;
  color: #222;
  /* box-shadow: 0 10px 65px -10px rgba(0, 0, 0, 0.05), 0 0 4px #ddd; */
  text-align: center;
  width: 100%;
  box-sizing: border-box;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  font-weight: lighter;
}

[data-quantity] input:focus {
  outline: none;
  --tw-ring-color: #3fb0ff;
  /* Allows border radius on focus */
}

[data-quantity] input[type="number"]::-webkit-inner-spin-button,
[data-quantity] input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

[data-quantity] input[type="number"] {
  -moz-appearance: textfield;
}

[data-quantity] button {
  position: absolute;
  width: 2.8rem;
  height: 2.8rem;
  top: 0.6rem;
  display: block;
  padding: 0;
  margin: 0;
  border: 0;
  background: #fff
    url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="50"><path d="M17 25h16M67 25h16M75 17v16" fill="none" stroke="rgb(59,69,66)" stroke-width="1.5px" stroke-linecap="round" stroke-linejoin="round" /></svg>')
    no-repeat 0 0;
  background-size: 5.6rem 2.8rem;
  overflow: hidden;
  white-space: nowrap;
  text-indent: 100%;
  border-radius: 1.4rem;
  cursor: pointer;
  transition: opacity 0.15s;
  opacity: 0.5;
}

[data-quantity] button:active {
  background-position-y: 1px;
  box-shadow: inset 0 2px 12px -4px #c5d1d9;
}

[data-quantity] button:focus {
  outline: none;
}

[data-quantity] button:hover {
  opacity: 1;
}

[data-quantity] button.sub {
  left: 0.6rem;
}

[data-quantity] button.add {
  right: 0.6rem;
  background-position-x: -2.8rem;
}
</style>
