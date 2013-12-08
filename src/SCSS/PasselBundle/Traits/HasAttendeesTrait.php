<?php
namespace SCSS\PasselBundle\Traits;

use Doctrine\Common\Collections\ArrayCollection;

trait HasAttendeesTrait
{
    /**
     * @ORM\OneToMany(targetEntity="Attendee", mappedBy="passel")
     */
    protected $attendees;

    /**
     * Get attendees
     *
     * @return ArrayCollection
     */
    public function getAttendees()
    {
        return $this->attendees;
    }

    /**
     * Set attendees
     *
     * @param array $attendees attendees
     *
     * @return self
     */
    public function setAttendees(array $attendees)
    {
        if (! $attendees instanceof ArrayCollection) {
            $attendees = new ArrayCollection($attendees);
        }

        $this->attendees = $attendees;

        return $this;
    }

    /**
     * Has attendees
     *
     * @return boolean
     */
    public function hasAttendees()
    {
        return !$this->attendees->isEmpty();
    }

    /**
     * Get an attendee
     *
     * @param Attendee|String $attendee attendee
     *
     * @return Attendee
     */
    public function getAttendee($attendee)
    {
        return $this->attendees->get($attendee);
    }

    /**
     * Add an attendee
     *
     * @param Attendee $attendee attendee
     *
     * @return self
     */
    public function addAttendee(Attendee $attendee)
    {
        $this->attendees->add($attendee);

        return $this;
    }

    /**
     * Remove an attendee
     *
     * @param Attendee|String $attendee attendee
     *
     * @return self
     */
    public function removeAttendee($attendee)
    {
        $this->attendees->remove($attendee);

        return $this;
    }
}