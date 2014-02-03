Passel Bundle > Entities > Passel
=================================
Passel entity.

Attributes
----------
- id :: primary key
- name :: name of passel
- [Type](type.md) :: `Type` entity
- [Council](council.md) :: `Council` entity
- [Region](region.md) :: `Region` entity
- [Factions](faction.md) :: `ArrayCollection` of `Faction` entities
- [Leader](leader.md) :: Primary `Leader` entity 
- [Leaders](leader.md) :: `ArrayCollection` of `Leader` entities
- [Enrollments](passel_enrollment.md) :: `ArrayCollection` of `PasselEnrollment` entities
- [Attendees](attendee.md) :: `ArrayCollection` of `Attendee` entities

Methods
-------
- getId
- getName
- getCouncil
- getRegion
- getFaction
- getFactions
- hasFaction
- getLeader
- getLeaders
- hasLeaders
- getEnrollments
- hasEnrollments
- getAttendee
- getAttendees
- hasAttendee