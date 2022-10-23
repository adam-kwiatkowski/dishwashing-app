export const LongPress = {
  beforeMount(el, binding) {

    let pressTimer = null

    const start = (e) => {
      if (e.type === 'click' && e.button !== 0) {
        return
      }

      if (pressTimer === null) {
        pressTimer = setTimeout(() => {
          // Run function
          handler()
        }, 500)
      }
    }

    // Cancel Timeout
    const cancel = () => {
      // Check if timer has a value or not
      if (pressTimer !== null) {
        clearTimeout(pressTimer)
        pressTimer = null
      }
    }

    // Run function when long pressed
    const handler = (e) => {
      binding.value(e)
    }

    // Add Event listeners
    el.addEventListener('mousedown', start)
    el.addEventListener('touchstart', start)
    // Cancel timeouts if these events happen
    el.addEventListener('click', cancel)
    el.addEventListener('mouseout', cancel)
    el.addEventListener('touchend', cancel)
    el.addEventListener('touchcancel', cancel)
  },
}
