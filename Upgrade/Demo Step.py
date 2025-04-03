import RPi.GPIO as gpio
from time import sleep

step_enpin = [23,25,7,12]
step_dirpin = [24,8,1,16]

gpio.setmode(gpio.BCM)
for a in range(len(step_enpin)-1):
    gpio.setup(step_enpin[a], gpio.OUT)
    gpio.setup(step_dirpin[a], gpio.OUT)
    gpio.output(step_dirpin[a],0)

def run_step(pin,dir,time):
    gpio.output(step_dirpin[pin],dir)
    gpio.output(step_enpin[pin],gpio.HIGH)
    sleep(time)
    gpio.output(step_enpin[pin],gpio.LOW)

try:
    while True:
        run_step(1,1,1)
        sleep(1)

     
except KeyboardInterrupt:
    gpio.cleanup()